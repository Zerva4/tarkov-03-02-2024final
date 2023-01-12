<?php

namespace App\Command;

use App\Entity\Map;
use App\Entity\Quests\Quest;
use App\Entity\Quests\QuestObjective;
use App\Entity\Trader;
use App\Interfaces\GraphqlClientInterface;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
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
    public static array $objectiveTypes = [
        null => 'TYPE_NULL',
        'plantItem' => 'TYPE_PLANT_ITEM',
        'shoot' => 'TYPE_SHOOT',
        'traderLevel' => 'TYPE_TRADER_LEVEL',
        'findItem' => 'TYPE_FIND_ITEM',
        'giveQuestItem' => 'TYPE_GIVE_QUEST_ITEM',
        'plantQuestItem' => 'TYPE_PLANT_QUEST_ITEM',
        'mark' => 'TYPE_MARK',
        'findQuestItem' => 'TYPE_FIND_QUEST_ITEM',
        'giveItem' => 'TYPE_GIVE_ITEM',
        'playerLevel' => 'TYPE_PLAYER_LEVEL',
        'buildWeapon' => 'TYPE_BUILD_WEAPON',
        'extract' => 'TYPE_EXTRACT',
        'taskStatus' => 'TYPE_TASK_STATUS',
        'visit' => 'TYPE_VISIT',
        'skill' => 'TYPE_SKILL',
        'experience' => 'TYPE_EXPERIENCE',
    ];
    private EntityManagerInterface $em;
    private GraphqlClientInterface $client;

    public function __construct(EntityManagerInterface $em, GraphqlClientInterface $client) {
        parent::__construct();
        $this->em = $em;
        $this->client = $client;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('This command allows you to import or update quests from https://tarkov.dev./api')
            ->addOption('lang', 'l', InputArgument::OPTIONAL, 'Language', default: 'ru')
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
                    tarkovDataId,
                    name,
                    normalizedName,
                    experience,
                    minPlayerLevel,
                    descriptionMessageId,
                    startMessageId,
                    successMessageId,
                    failMessageId,
                    trader {
                        id
                    },
                    taskRequirements {
                        task {
                            id
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

        try {
            $response = $this->client->query($query);
            $quests = $response['data']['tasks'];
        } catch (Exception $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }

        if (null === $quests) {
            $io->warning('Nothing to import or update.');
        }

        $progressBar = new ProgressBar($output, count($quests));
        $progressBar->advance(0);
        $questRepository = $this->em->getRepository(Quest::class);
        $questObjectiveRepository = $this->em->getRepository(QuestObjective::class);
        $traderRepository = $this->em->getRepository(Trader::class);
        $mapRepository = $this->em->getRepository(Map::class);

        foreach ($quests as $quest) {
            $order = (null !== $quest['tarkovDataId']) ? $quest['tarkovDataId'] : 0;
            $questEntity = $questRepository->findOneBy(['apiId' => $quest['id']]);

            if ($questEntity instanceof Quest) {
                $questEntity->setDefaultLocale($lang);
                $questEntity->translate($lang, false)->setTitle($quest['name']);
            } else {
                $questEntity = new Quest($lang);
                $questEntity->translate($lang, false)->setTitle($quest['name']);
                $questEntity->setApiId($quest['id']);
            }

            $questSlugName = (null !== $quest['normalizedName']) ? $quest['normalizedName'] : $quest['id'];

            $questEntity
                ->setPosition($order)
                ->setPublished(true)
                ->setExperience($quest['experience'])
                ->setMinPlayerLevel($quest['minPlayerLevel'])
                ->setSlug($questSlugName)
            ;

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
                        ->setType(self::$objectiveTypes[$objective['type']])
                        ->setOptional($objective['optional'])
                        ->setQuest($questEntity)
                        ->translate($lang, false)->setDescription($objective['description'])
                    ;
                    $this->em->persist($objectiveEntity);
                    $objectiveEntity->mergeNewTranslations();
                    $questEntity->addObjective($objectiveEntity);
                }
            }
            // TODO: Set required quests
            // TODO: Set start rewards. Create after import items
            // TODO: Set finish rewards. Create after import items
            // TODO: Set needed keys. Create after import items

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
