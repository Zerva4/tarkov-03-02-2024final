<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Item\ContainedItem;
use App\Entity\Item\Item;
use App\Entity\Map;
use App\Entity\Quest\Quest;
use App\Entity\Quest\QuestKey;
use App\Entity\Quest\QuestObjective;
use App\Entity\Trader\Trader;
use App\Interfaces\GraphQLClientInterface;
use App\Interfaces\Item\ContainedItemInterface;
use App\Interfaces\Quest\QuestKeyInterface;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Imagick;
use ImagickPixel;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\KernelInterface;

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
        'useItem' => 'TYPE_USE_ITEM'
    ];
    private EntityManagerInterface $em;
    private GraphQLClientInterface $client;
    protected string $storageDir;

    public function __construct(EntityManagerInterface $em, GraphQLClientInterface $client, KernelInterface $kernel) {
        parent::__construct();
        $this->em = $em;
        $this->client = $client;
        $this->storageDir = $kernel->getContainer()->getParameter('app.quests.images.path') . '/';
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
                    taskImageLink,
                    minPlayerLevel,
                    restartable,
                    kappaRequired,
                    lightkeeperRequired,
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
                    traderRequirements {
                        id
                        requirementType
                        compareMethod
                        value
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
                                id
                            }
                        count, quantity
                        }
                    },
                    finishRewards {
                        items {
                            item {
                                id
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
                        map {
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
        $itemRepository = $this->em->getRepository(Item::class);
        $containedItemRepository = $this->em->getRepository(ContainedItem::class);
        $questKeyRepository = $this->em->getRepository(QuestKey::class);

        foreach ($quests as $quest) {
            $order = (null !== $quest['tarkovDataId']) ? $quest['tarkovDataId'] : 0;
            $questEntity = $questRepository->findOneBy(['apiId' => $quest['id']]);

            if ($questEntity instanceof Quest) {
                $questEntity->setDefaultLocale($lang);
                $questEntity->setName($quest['name']);
            } else {
                $questEntity = new Quest($lang);
                $questEntity->setName($quest['name']);
                $questEntity->setApiId($quest['id']);
            }

            $questSlugName = (null !== $quest['normalizedName']) ? $quest['normalizedName'] : $quest['id'];

            $questEntity
                ->setPosition($order)
                ->setPublished(true)
                ->setExperience($quest['experience'])
                ->setMinPlayerLevel($quest['minPlayerLevel'])
                ->setRestartable($quest['restartable'])
                ->setKappaRequired($quest['kappaRequired'])
                ->setLightkeeperRequired($quest['lightkeeperRequired'])
                ->setSlug($questSlugName)
            ;

            // Download file
            @unlink($this->storageDir.'*.webp');
            if (!$questEntity->getImageFile()) {
                $curlHandle = curl_init($quest['taskImageLink']);
                $fileName = basename($quest['taskImageLink']);
                $tmpFileName = $this->storageDir . $fileName;
                $fp = fopen($tmpFileName, 'wb');
                curl_setopt($curlHandle, CURLOPT_FILE, $fp);
                curl_setopt($curlHandle, CURLOPT_HEADER, 0);
                curl_exec($curlHandle);
                curl_close($curlHandle);
                fclose($fp);

                // Convert to png
                $saveFileName = (string)explode('.', $fileName, 2)[0] . '.png';
                $saveFilePath = $this->storageDir . $saveFileName;
                $im = new Imagick();
                $im->pingImage($tmpFileName);
                $im->readImage($tmpFileName);
                $im->setImageFormat('png');
                $im->setBackgroundColor(new ImagickPixel('transparent'));
                $im->writeImage($saveFilePath);
                unlink($tmpFileName);

                $questEntity->setImageName($saveFileName);
            }

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
                        ->setDescription($objective['description'])
                    ;
                    $this->em->persist($objectiveEntity);
                    $objectiveEntity->mergeNewTranslations();
                    $questEntity->addObjective($objectiveEntity);
                }
            }
            // TODO: Set required quests
            // TODO: Set start rewards. Create after import items
            // Set requiredItems
            if (count($quest['startRewards']['items']) > 0) {
                $startRewards = [];
                foreach ($quest['startRewards']['items'] as $item) {
                    $itemId = $item['item']['id'];
                    if (array_key_exists($itemId, $startRewards)) {
                        $startRewards[$itemId]['count'] = $startRewards[$itemId]['count'] + $item['count'];
                        $startRewards[$itemId]['quantity'] = $startRewards[$itemId]['quantity'] + $item['quantity'];
                    } else {
                        $startRewards[$itemId] = $item;
                    }
                }
                foreach ($startRewards as $key => $item) {
                    $containedQuestItem = $containedItemRepository->findQuestUsedItemByItemId($questEntity->getId(), $item['item']['id']);
                    if (!$containedQuestItem instanceof ContainedItemInterface) {
                        $containedQuestItem = new ContainedItem();
                    }
                    $itemEntity = $itemRepository->findOneBy(['apiId' => $item['item']['id']]);
                    $containedQuestItem->setItem($itemEntity);
                    $containedQuestItem->setApiId($item['item']['id']);
                    $containedQuestItem->setCount($item['count']);
                    $containedQuestItem->setQuantity($item['quantity']);
                    if (array_key_exists('attributes', $item)) $containedQuestItem->setAttributes($item['attributes']);
                    $questEntity->addUsedItem($containedQuestItem);
                    $this->em->persist($containedQuestItem);
                    unset($containedQuestItem, $itemEntity);
                }
            }

            // TODO: Set finish rewards. Create after import items
            // Set requiredItems
            if (count($quest['finishRewards']['items']) > 0) {
                $finishRewards = [];
                foreach ($quest['finishRewards']['items'] as $item) {
                    $itemId = $item['item']['id'];
                    if (array_key_exists($itemId, $finishRewards)) {
                        $finishRewards[$itemId]['count'] = $finishRewards[$itemId]['count'] + $item['count'];
                        $finishRewards[$itemId]['quantity'] = $finishRewards[$itemId]['quantity'] + $item['quantity'];
                    } else {
                        $finishRewards[$itemId] = $item;
                    }
                }

                foreach ($finishRewards as $key => $item) {
                    $containedQuestReceivedItem = $containedItemRepository->findReceivedItemByQuestAndItemId($questEntity->getId(), $item['item']['id']);
                    if (!$containedQuestReceivedItem instanceof ContainedItemInterface) {
                        $containedQuestReceivedItem = new ContainedItem();
                    }
                    $itemEntity = $itemRepository->findOneBy(['apiId' => $item['item']['id']]);
                    $containedQuestReceivedItem->setItem($itemEntity);
                    $containedQuestReceivedItem->setApiId($item['item']['id']);
                    $containedQuestReceivedItem->setCount($item['count']);
                    $containedQuestReceivedItem->setQuantity($item['quantity']);
                    if (array_key_exists('attributes', $item)) $containedQuestReceivedItem->setAttributes($item['attributes']);
                    $questEntity->addReceivedItem($containedQuestReceivedItem);
                    $this->em->persist($containedQuestReceivedItem);
                    unset($containedQuestReceivedItem, $itemEntity);
                }
            }

            // TODO: Set needed keys. Create after import items
            if (!empty($quest['neededKeys'])) {
                foreach($quest['neededKeys'] as $neededKey) {
                    foreach ($neededKey['keys'] as $key) {
                        $mapEntity = null;
                        $questKeyEntity = null;
                        if (array_key_exists('map', $neededKey)) {
                            $mapEntity = $mapRepository->findOneBy(['apiId' => $neededKey['map']['id']]);
                        }
                        $questKeyEntity = $questKeyRepository->findByQuestAndItemIds($questEntity->getId(), $key['id']);

                        if (!$questKeyEntity instanceof QuestKeyInterface) {
//                            dump($questKeyEntity);
//                            die();
                            $itemEntity = $itemRepository->findOneBy(['apiId' => $key['id']]);
                            if (null === $itemEntity) continue;
                            $keyEntity = new QuestKey();
                            $keyEntity->setItem($itemEntity)->setMap($mapEntity);
                            $questEntity->addNeededKey($keyEntity);
                            $this->em->persist($keyEntity);
                        }
                        unset($itemEntity, $questKeyEntity, $mapEntity);
                    }
                }
            }

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
