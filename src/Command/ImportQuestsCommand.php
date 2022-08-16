<?php

namespace App\Command;

use App\Entity\Map;
use App\Entity\Quest;
use App\Entity\QuestObjective;
use App\Entity\Trader;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:import:quests',
    description: 'Import or update quests from https://tarkov.dev./api',
)]
class ImportQuestsCommand extends Command
{
    protected static array $headers = ['Content-Type: application/json'];
    private ?EntityManagerInterface $em = null;

    public function __construct(EntityManagerInterface $em) {
        parent::__construct();

        $this->em = $em;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('This command allows you to import or update quests from https://tarkov.dev./api')
            ->addOption('lang', 'l', InputArgument::OPTIONAL, 'Admin login', default: 'ru')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $lang = $input->getOption('lang');

        $query = <<< GRAPHQL
            {
                tasks(lang: $lang) {
                    id,
                    name,
                    experience,
                    minPlayerLevel,
                    descriptionMessageId,
                    startMessageId,
                    successMessageId,
                    failMessageId,
                    trader {
                        id,
                        name
                    },
                    taskRequirements {
                        task {
                            name
                        },
                        status
                    }
                    objectives {
                        id,
                        type,
                        optional,
                        description
                        maps {
                            name
                        }
                    }
                    startRewards {
                        __typename,
                        items {
                            item {
                                name
                            }
                        count, quantity
                        }
                    },
                    finishRewards {
                        items {
                            item {
                                types
                                name
                            }
                            count,
                            quantity,
                            attributes {
                                type, name, value
                            }
                        }
                    }
                    factionName,
                    experience,
                    neededKeys {
                        keys {
                            id, name
                        }
                    }
                    map {
                        id, name
                    }
                }
        }
        GRAPHQL;

        $data = @file_get_contents('https://api.tarkov.dev/graphql', false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => self::$headers,
                'content' => json_encode(['query' => $query]),
            ]
        ]));
        $quests = (json_decode($data, true)['data']['tasks']);
        if (null === $quests) {
            $io->warning('Nothing to import or update.');
        }

        $progressBar = new ProgressBar($output, count($quests));
        $progressBar->advance(1);
        $questRepository = $this->em->getRepository(Quest::class);
        $questObjectiveRepository = $this->em->getRepository(QuestObjective::class);
        $traderRepository = $this->em->getRepository(Trader::class);
        $mapRepository = $this->em->getRepository(Map::class);

        foreach ($quests as $quest) {
            $questEntity = $questRepository->findOneBy(['apiId' => $quest['id']]);

            if ($questEntity instanceof Quest) {
                $questEntity->setDefaultLocale($lang);
            } else {
                $questEntity = new Quest($lang);
            }

            $questEntity
                ->setApiId($quest['id'])
                ->setPublished(true)
                ->setExperience($quest['experience'])
                ->setMinPlayerLevel($quest['minPlayerLevel'])
                ->setSlug($quest['id'])
            ;
            $questEntity->translate($lang, false)->setTitle($quest['name']);

            // Set trader
            if (null !== $quest['trader']['id']) {
                $traderEntity = $traderRepository->findOneBy(['apiId' => $quest['trader']['id']]);
                if ($traderEntity instanceof Trader) {
                    $questEntity->setTrader($traderEntity);
                }
            }

            // Set map
            if (null !== $quest['map']) {
                $mapEntity = $mapRepository->findOneBy(['apiId' => $quest['map']['id']]);
                if ($mapEntity instanceof Map) {
                    $questEntity->setMap($mapEntity);
                }
            }

            // Set objectives
            if (count($quest['objectives']) > 0) {
                foreach ($quest['objectives'] as $objective) {
                    $objectiveEntity = $questObjectiveRepository->findOneBy(['apiId' => $objective['id']]);

                    if (!$objectiveEntity instanceof QuestObjective) {
                        $objectiveEntity = new QuestObjective($lang);
                        $objectiveEntity->setApiId($objective['id']);
                    }

                    $objectiveEntity->setDefaultLocale($lang);
                    $objectiveEntity
                        ->setType($objective['type'])
                        ->setOptional($objective['optional'])
                        ->setQuest($questEntity)
                        ->translate($lang, false)->setDescription($objective['description'])
                    ;
                    $this->em->persist($objectiveEntity);
                    $objectiveEntity->mergeNewTranslations();
                    $questEntity->addObjective($objectiveEntity);
                }
            }
            // Set needed keys
            // TODO: Create after import items

            $this->em->persist($questEntity);
            $questEntity->mergeNewTranslations();
            $progressBar->advance();
        }
        $this->em->flush();
        $progressBar->finish();
        $io->success('Quests imported.');

        return Command::SUCCESS;
    }
}
