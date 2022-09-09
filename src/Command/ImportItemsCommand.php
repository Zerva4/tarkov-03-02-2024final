<?php

namespace App\Command;

use App\Entity\Item;
use App\Entity\Quest;
use App\Interfaces\ItemInterface;
use App\Interfaces\QuestInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:import:items',
    description: 'Import or update items from https://tarkov.dev./api',
)]
class ImportItemsCommand extends Command
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
            ->setDescription('This command allows you to import or update items from https://tarkov.dev./api')
            ->addOption('lang', 'l', InputArgument::OPTIONAL, 'Language', default: 'ru')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $lang = $input->getOption('lang');

        $query = <<< GRAPHQL
            {
            items(ids: "5447a9cd4bdc2dbd208b4567", lang: $lang) {
                id,
                updated,
                name,
                shortName,
                normalizedName,
                basePrice,
                width, height, backgroundColor
                inspectImageLink
                types,
                        # properties {
                        # ... Ammo
                        # ... Grenade
                        # }
                accuracyModifier,
                recoilModifier,
                ergonomicsModifier,
                hasGrid,
                blocksHeadphones,
                receivedFromTasks {
                  id, name
                },
                usedInTasks {
                  id, name
                }
                weight,
                velocity,
                loudness,
                bartersFor {
                  id,
                  trader {
                    name
                  },
                  level
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

        $items = (json_decode($data, true)['data']['items']);
        if (null === $items) {
            $io->warning('Nothing to import or update.');
        }

        $progressBar = new ProgressBar($output, count($items));
        $progressBar->advance(0);
        $itemRepository = $this->em->getRepository(Item::class);
        $questRepository = $this->em->getRepository(Quest::class);

        foreach ($items as $item) {
            dump($item);
            $itemEntity = $itemRepository->findOneBy(['apiId' => $item['id']]);

            if ($itemEntity instanceof ItemInterface) {
                $itemEntity->setDefaultLocale($lang);
                $itemEntity->translate($lang, false)->setTitle($item['name']);
            } else {
                /** @var ItemInterface $mapEntity */
                $itemEntity = new Item($lang);
                $itemEntity->setDefaultLocale($lang);
                $itemEntity->translate($lang, false)->setTitle($item['name']);
                $itemEntity->setApiId($item['id']);
            }

            // Set another params
            $hasGrid = (null !== $item['hasGrid']) ? $item['hasGrid'] : false;
            $blocksHeadphones = (null !== $item['blocksHeadphones']) ? $item['blocksHeadphones'] : false;
            $itemEntity->setPublished(true)
                ->setSlug($item['normalizedName'])
                ->setTypes($item['types'])
                ->setBasePrice($item['basePrice'])
                ->setWidth($item['width'])
                ->setHeight($item['height'])
                ->setBackgroundColor($item['backgroundColor'])
                ->setAccuracyModifier($item['accuracyModifier'])
                ->setRecoilModifier($item['recoilModifier'])
                ->setErgonomicsModifier($item['recoilModifier'])
                ->setHasGrid($hasGrid)
                ->setBlocksHeadphones($blocksHeadphones)
                ->setWeight($item['weight'])
                ->setVelocity($item['velocity'])
                ->setLoudness($item['loudness'])
                ->mergeNewTranslations()
            ;
            $this->em->persist($itemEntity);

            // Set received from quests
            if (is_array($item['receivedFromTasks']) && count($item['receivedFromTasks']) > 0) {
                foreach ($item['receivedFromTasks'] as $key => $receivedFromQuest) {
                    $questEntity = $questRepository->findOneBy(['apiId' => $receivedFromQuest['id']]);
                    if ($questEntity instanceof QuestInterface) {
                        $itemEntity->addReceivedFromQuest($questEntity);
                    }
                }
            }

            // Set used in quest
            if (is_array($item['usedInTasks']) && count($item['usedInTasks']) > 0) {
                foreach ($item['usedInTasks'] as $usedInTask) {
                    $questEntity = $questRepository->findOneBy(['apiId' => $usedInTask['id']]);
                    if ($questEntity instanceof QuestInterface) {
                        $itemEntity->addUsedInQuest($questEntity);
                    }
                }
            }

            $progressBar->advance();
            $this->em->flush();
        }

        $progressBar->finish();
        $io->success('Items imported.');

        return Command::SUCCESS;
    }
}
