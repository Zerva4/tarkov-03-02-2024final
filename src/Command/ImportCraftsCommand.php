<?php

namespace App\Command;

use App\Entity\Barter;
use App\Entity\Item\ContainedItem;
use App\Entity\Item\Item;
use App\Entity\Quest\Quest;
use App\Entity\Trader\Trader;
use App\Entity\Workshop\Craft;
use App\Entity\Workshop\Place;
use App\Interfaces\BarterInterface;
use App\Interfaces\GraphQLClientInterface;
use App\Interfaces\Item\ContainedItemInterface;
use App\Interfaces\Trader\TraderInterface;
use App\Interfaces\Workshop\CraftInterface;
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
    name: 'app:import:crafts',
    description: 'Import or update crafts from https://tarkov.dev./api',
)]
class ImportCraftsCommand extends Command
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
            ->setDescription('This command allows you to import or update crafts from https://tarkov.dev./api')
//            ->addOption('lang', 'l', InputArgument::OPTIONAL, 'Language', default: 'ru')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $query = <<< GRAPHQL
            {
                crafts(lang: ru) {
                    id
                    station {
                      id
                    }
                    taskUnlock {
                      id
                    }
                    level
                    duration
                    requiredItems {
                        item {
                          id
                        }
                        count
                        quantity
                    }
                    requiredQuestItems {
                      id
                      name
                    }
                    rewardItems {
                      item {
                          id
                      }
                      count
                      quantity
                    }
                }
            }
        GRAPHQL;

        try {
            $response = $this->client->query($query);
            $crafts = $response['data']['crafts'];
        } catch (Exception $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }

        if (null === $crafts) {
            $io->warning('Nothing to import or update.');
        }

        $progressBar = new ProgressBar($output, count($crafts));
        $progressBar->advance(0);

        $craftRepository = $this->em->getRepository(Craft::class);
        $containedItemRepository = $this->em->getRepository(ContainedItem::class);
        $questRepository =  $this->em->getRepository(Quest::class);
        $placeRepository =  $this->em->getRepository(Place::class);
        $itemRepository = $this->em->getRepository(Item::class);

        foreach ($crafts as $craft) {
            $progressBar->advance();
            $craftEntity = $craftRepository->findOneBy(['apiId' => $craft['id']]);

            if (!$craftEntity instanceof CraftInterface) {
                $craftEntity = new Craft();
                $craftEntity->setPublished(true);
                $craftEntity->setApiId($craft['id']);
            }

            // Set level
            $craftEntity->setLevel($craft['level']);

            // Set duration
            $craftEntity->setDuration($craft['duration']);

            // Set place
            $placeEntity = $placeRepository->findOneBy(['apiId' => $craft['station']['id']]);
            $craftEntity->setPlace($placeEntity);

            // Set unlock task
            if (null !== $craft['taskUnlock']) {
                $questEntity = $questRepository->findOneBy(['apiId' => $craft['taskUnlock']['id']]);
                $craftEntity->setUnlockQuest($questEntity);
            }

            // Set requiredItems
            foreach ($craft['requiredItems'] as $requiredItem) {
                $containedRequiredItemEntity = $containedItemRepository->findCraftRequiredItemByItemId($craftEntity->getId(), $requiredItem['item']['id']);

                if (!$containedRequiredItemEntity instanceof ContainedItemInterface) {
                    $containedRequiredItemEntity = new ContainedItem();
                }
                $itemEntity = $itemRepository->findOneBy(['apiId' => $requiredItem['item']['id']]);
                $containedRequiredItemEntity->setItem($itemEntity);
                $containedRequiredItemEntity->setCount($requiredItem['count']);
                $containedRequiredItemEntity->setQuantity($requiredItem['quantity']);
                $craftEntity->addRequiredContainedItem($containedRequiredItemEntity);
                $this->em->persist($containedRequiredItemEntity);
                unset($containedRequiredItemEntity);
            }

            // Set requiredItems
            foreach ($craft['rewardItems'] as $rewardItem) {
                $containedRewardItemEntity = $containedItemRepository->findCraftRewardItemByItemId($craftEntity->getId(), $rewardItem['item']['id']);
                if (!$containedRewardItemEntity instanceof ContainedItemInterface) {
                    $containedRewardItemEntity = new ContainedItem();
                }
                $itemEntity = $itemRepository->findOneBy(['apiId' => $rewardItem['item']['id']]);
                $containedRewardItemEntity->setItem($itemEntity);
                $containedRewardItemEntity->setCount($rewardItem['count']);
                $containedRewardItemEntity->setQuantity($rewardItem['quantity']);
                $craftEntity->addRewardContainedItem($containedRewardItemEntity);
                $this->em->persist($containedRewardItemEntity);
                unset($containedRewardItemEntity);
            }
            $this->em->persist($craftEntity);
        }
        $this->em->flush();
        $progressBar->finish();
        $io->success('Crafts imported.');

        return Command::SUCCESS;
    }
}
