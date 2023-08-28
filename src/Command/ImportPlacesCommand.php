<?php

namespace App\Command;

use App\Entity\Item\ContainedItem;
use App\Entity\Item\Item;
use App\Entity\Skill;
use App\Entity\Trader\Trader;
use App\Entity\Trader\TraderRequired;
use App\Entity\Workshop\Place;
use App\Entity\Workshop\PlaceLevel;
use App\Entity\Workshop\PlaceLevelRequired;
use App\Interfaces\GraphQLClientInterface;
use App\Interfaces\Item\ContainedItemInterface;
use App\Interfaces\SkillInterface;
use App\Interfaces\Trader\TraderRequiredInterface;
use App\Interfaces\Workshop\PlaceInterface;
use App\Interfaces\Workshop\PlaceLevelInterface;
use App\Interfaces\Workshop\PlaceLevelRequiredInterface;
use App\Repository\Item\ContainedItemRepository;
use App\Repository\Item\ItemRepository;
use App\Repository\SkillRepository;
use App\Repository\Trader\TraderRepository;
use App\Repository\Trader\TraderRequiredRepository;
use App\Repository\Workshop\PlaceLevelRepository;
use App\Repository\Workshop\PlaceLevelRequiredRepository;
use App\Repository\Workshop\PlaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\KernelInterface;

#[AsCommand(
    name: 'app:import:places',
    description: 'Import or update places from https://tarkov.dev./api',
)]
class ImportPlacesCommand extends Command
{
    private ?EntityManagerInterface $em;
    private GraphQLClientInterface $client;

    public function __construct(EntityManagerInterface $em, GraphQLClientInterface $client, KernelInterface $kernel) {
        parent::__construct();

        $this->em = $em;
        $this->client = $client;
    }
    protected function configure(): void
    {
        $this
            ->setDescription('This command allows you to import or update places from https://tarkov.dev./api')
            ->addOption('lang', 'l', InputArgument::OPTIONAL, 'Language', default: 'ru')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $lang = $input->getOption('lang');

        $query = <<< GRAPHQL
            {
                hideoutStations(lang: {$lang}) {
                    id
                    name
                    normalizedName
                    tarkovDataId
                    levels {
                      id
                      tarkovDataId
                      level
                      constructionTime
                      description
                      itemRequirements {
                        id
                        item {
                          id
                          name
                        }
                        count
                        quantity
                      }
                      stationLevelRequirements {
                        id
                        station {
                          id
                          name
                        }
                        level
                      }
                      skillRequirements {
                        id
                        name
                        level
                      }
                      traderRequirements {
                        id,
                        trader {
                          id
                          name
                        }
                        # requirementType
                        # compareMethod
                        level
                      }
                    }
                  }
            }
        GRAPHQL;

        try {
            $response = $this->client->query($query);
            $places = $response['data']['hideoutStations'];
        } catch (Exception $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }

        if (null === $places) {
            $io->warning('Nothing to import or update.');
        }

        $progressBar = new ProgressBar($output, count($places));
        $progressBar->advance(0);

        /** @var PlaceRepository $placeRepository */
        $placeRepository = $this->em->getRepository(Place::class);
        /** @var PlaceLevelRepository $placeLevelRepository */
        $placeLevelRepository = $this->em->getRepository(PlaceLevel::class);
        /** @var PlaceLevelRequiredRepository $placeLevelRequiredRepository */
        $placeLevelRequiredRepository = $this->em->getRepository(PlaceLevelRequired::class);
        /** @var ContainedItemRepository $containedItemRepository */
        $containedItemRepository = $this->em->getRepository(ContainedItem::class);
        /** @var ItemRepository $itemRepository */
        $itemRepository = $this->em->getRepository(Item::class);
        /** @var SkillRepository $skillRepository */
        $skillRepository = $this->em->getRepository(Skill::class);
        /** @var TraderRequiredRepository $traderRequiredRepository */
        $traderRequiredRepository = $this->em->getRepository(TraderRequired::class);
        /** @var TraderRepository $traderRepository */
        $traderRepository = $this->em->getRepository(Trader::class);

        // Add places
        foreach ($places as $place) {
            $progressBar->advance();
            $placeEntity = $placeRepository->findOneBy(['apiId' => $place['id']]);

            if (!$placeEntity instanceof PlaceInterface) {
                $placeEntity = new Place();
                $placeEntity->setPublished(true);
                $placeEntity->setApiId($place['id']);
            }

            $order = (null !== $place['tarkovDataId']) ? (int)$place['tarkovDataId'] : 0;
            $placeEntity->setOrderPlace($order);
            $placeEntity->setSlug($place['normalizedName']);
            $placeEntity->setDefaultLocale($lang);
            $placeEntity->translate($lang, false)->setName($place['name']);
            $placeEntity->mergeNewTranslations();

            // Add levels
            foreach ($place['levels'] as $level) {
                $placeLevelEntity = $placeLevelRepository->findOneBy(['apiId' => $level['id'], 'level' => $level['level']]);
                $order = (null !== $level['tarkovDataId']) ? (int)$level['tarkovDataId'] : 0;

                if (!$placeLevelEntity instanceof PlaceLevelInterface) {
                    $placeLevelEntity = new PlaceLevel();
                    $placeLevelEntity->setPublished(true);
                    $placeLevelEntity->setApiId($level['id']);
                }

                $placeLevelEntity->setDefaultLocale($lang);
                $placeLevelEntity->translate($lang, false)->setDescription($level['description']);
                $placeLevelEntity->setLevelOrder($order);
                $placeLevelEntity->setConstructionTime($level['constructionTime']);
                $placeLevelEntity->setLevel($level['level']);
                $placeLevelEntity->mergeNewTranslations();

                // Add required items
                foreach ($level['itemRequirements'] as $requiredItem) {
                    $containedRequiredItemEntity = $containedItemRepository->findPlaceLevelRequiredForByItemId(
                        $placeLevelEntity->getId(),
                        $requiredItem['item']['id']
                    );

                    if (!$containedRequiredItemEntity instanceof ContainedItemInterface) {
                        $containedRequiredItemEntity = new ContainedItem();
                        $containedRequiredItemEntity->setApiId($requiredItem['item']['id']);
                    }

                    $itemEntity = $itemRepository->findOneBy(['apiId' => $requiredItem['item']['id']]);
                    $containedRequiredItemEntity->setItem($itemEntity);
                    $containedRequiredItemEntity->setCount($requiredItem['count']);
                    $containedRequiredItemEntity->setQuantity($requiredItem['quantity']);
                    $this->em->persist($containedRequiredItemEntity);
                    $placeLevelEntity->addRequiredItem($containedRequiredItemEntity);
                    unset($containedRequiredItemEntity);
                }

                // Import required traders
                foreach ($level['traderRequirements'] as $requiredTrader) {
                    $traderRequiredEntity = $traderRequiredRepository->findByPlaceLevelRequiredByTraderId(
                        $placeLevelEntity->getId(),
                        $requiredTrader['trader']['id']
                    );

                    if (!$traderRequiredEntity instanceof TraderRequiredInterface) {
                        $traderRequiredEntity = new TraderRequired();
                        $traderRequiredEntity->setApiId($requiredTrader['trader']['id']);
                    }

                    $traderEntity = $traderRepository->findOneBy(['apiId' => $requiredTrader['trader']['id']]);
                    $traderRequiredEntity->setTrader($traderEntity);
                    $traderRequiredEntity->setLevel($requiredTrader['level']);
                    $this->em->persist($traderRequiredEntity);
                    $placeLevelEntity->addRequiredTrader($traderRequiredEntity);
                    unset($traderRequiredEntity);
                }

                // Add skills
                foreach ($level['skillRequirements'] as $skill) {
                    $skillEntity = $skillRepository->findOneBy(['apiId' => $skill['id'], 'level' => $skill['level']]);

                    if (!$skillEntity instanceof SkillInterface) {
                        $skillEntity = new Skill();
                        $skillEntity->setApiId($skill['id']);
                    }
                    $skillEntity->setDefaultLocale($lang);
                    $skillEntity->translate($lang, false)->setName($skill['name']);
                    $skillEntity->mergeNewTranslations();
                    $skillEntity->setLevel((int)$skill['level']);
                    $this->em->persist($skillEntity);
                    $placeLevelEntity->addRequiredSkill($skillEntity);
                }

                $this->em->persist($placeLevelEntity);
                $placeEntity->addLevel($placeLevelEntity);
            }

            $this->em->persist($placeEntity);
        }
        $this->em->flush();

        // Add required place levels
        foreach ($places as $place) {
            foreach ($place['levels'] as $level) {
                $placeLevelEntity = $placeLevelRepository->findOneBy(['apiId' => $level['id'], 'level' => $level['level']]);

                foreach ($level['stationLevelRequirements'] as $requiredPlace) {
                    $requiredPlaceEntity = $placeRepository->findOneBy([
                        'apiId' => $requiredPlace['station']['id']
                    ]);
                    $requiredPlaceLevelEntity = $placeLevelRequiredRepository->findOneBy([
                        'apiId' => $requiredPlace['id'],
                        'level' => $requiredPlace['level']
                    ]);

                    if (!$requiredPlaceLevelEntity instanceof PlaceLevelRequiredInterface) {
                        $requiredPlaceLevelEntity = new PlaceLevelRequired();
                        $requiredPlaceLevelEntity->setApiId($requiredPlace['id']);
                    }

                    $requiredPlaceLevelEntity->setPlace($requiredPlaceEntity);
                    $requiredPlaceLevelEntity->setLevel($requiredPlace['level']);
                    $this->em->persist($requiredPlaceLevelEntity);
                    $placeLevelEntity->addRequiredPlaceLevel($requiredPlaceLevelEntity);
                    $requiredPlaceEntity->addPlaceRequiredLevel($requiredPlaceLevelEntity);
                }
                $this->em->persist($placeLevelEntity);
            }
        }
        $this->em->flush();
        $progressBar->finish();
        $io->success('Places imported.');

        return Command::SUCCESS;
    }
}
