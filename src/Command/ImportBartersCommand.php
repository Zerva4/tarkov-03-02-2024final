<?php

namespace App\Command;

use App\Entity\Barter;
use App\Entity\Item\ContainedItem;
use App\Entity\Item\Item;
use App\Entity\Quest\Quest;
use App\Entity\Trader\Trader;
use App\Interfaces\BarterInterface;
use App\Interfaces\GraphQLClientInterface;
use App\Interfaces\Item\ContainedItemInterface;
use App\Interfaces\Trader\TraderInterface;
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
    name: 'app:import:barters',
    description: 'Import or update barters from https://tarkov.dev./api',
)]
class ImportBartersCommand extends Command
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
            ->setDescription('This command allows you to import or update barters from https://tarkov.dev./api')
            ->addOption('lang', 'l', InputArgument::OPTIONAL, 'Language', default: 'ru')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $query = <<< GRAPHQL
            {
                barters(lang: ru) {
                    id
                    trader {
                      id
                    }
                    level
                    taskUnlock {
                      id
                    }
                    requiredItems {
                      item {
                        id
                      }
                      count
                      quantity
                      attributes {
                        type
                        name
                        value
                      }
                    }
                    rewardItems {
                      item {
                        id
                        name
                      }
                      count
                      quantity
                      attributes {
                        type
                        name
                        value
                      }
                    }
                }
            }
        GRAPHQL;

        try {
            $response = $this->client->query($query);
            $barters = $response['data']['barters'];
        } catch (Exception $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }

        if (null === $barters) {
            $io->warning('Nothing to import or update.');
        }

        $progressBar = new ProgressBar($output, count($barters));
        $progressBar->advance(0);

        $barterRepository = $this->em->getRepository(Barter::class);
        $traderRepository = $this->em->getRepository(Trader::class);
        $questRepository =  $this->em->getRepository(Quest::class);
        $containedItemRepository = $this->em->getRepository(ContainedItem::class);
        $itemRepository = $this->em->getRepository(Item::class);

        foreach ($barters as $barter) {
            $progressBar->advance();
            $barterEntity = $barterRepository->findOneBy(['apiId' => $barter['id']]);

            if (!$barterEntity instanceof BarterInterface) {
                $barterEntity = new Barter();
                $barterEntity->setPublished(true);
                $barterEntity->setApiId($barter['id']);
            }

            // Set trader
            /** @var TraderInterface $traderEntity */
            $traderEntity = $traderRepository->findOneBy(['apiId' => $barter['trader']['id']]);
            $barterEntity->setTrader($traderEntity);

            // Set level
            $barterEntity->setTraderLevel($barter['level']);

            // Set unlock task
            if (null !== $barter['taskUnlock']) {
                $questEntity = $questRepository->findOneBy(['apiId' => $barter['taskUnlock']['id']]);
                $barterEntity->setQuestUnlock($questEntity);
            }

            // Set requiredItems
            foreach ($barter['requiredItems'] as $requiredItem) {
                $containedRequiredItemEntity = $containedItemRepository->findBarterRequiredItemByItemId($barterEntity->getId(), $requiredItem['item']['id']);

                if (!$containedRequiredItemEntity instanceof ContainedItemInterface) {
                    $containedRequiredItemEntity = new ContainedItem();
                }
                $itemEntity = $itemRepository->findOneBy(['apiId' => $requiredItem['item']['id']]);
                $containedRequiredItemEntity->setItem($itemEntity);
                $containedRequiredItemEntity->setCount($requiredItem['count']);
                $containedRequiredItemEntity->setQuantity($requiredItem['quantity']);
                $containedRequiredItemEntity->setAttributes($requiredItem['attributes']);
                $barterEntity->addRequiredItem($containedRequiredItemEntity);
                $this->em->persist($containedRequiredItemEntity);
                unset($containedRequiredItemEntity);
            }

            // Set requiredItems
            foreach ($barter['rewardItems'] as $rewardItem) {
                $containedRewardItemEntity = $containedItemRepository->findBarterRewardItemByItemId($barterEntity->getId(), $rewardItem['item']['id']);
                if (!$containedRewardItemEntity instanceof ContainedItemInterface) {
                    $containedRewardItemEntity = new ContainedItem();
                }
                $itemEntity = $itemRepository->findOneBy(['apiId' => $rewardItem['item']['id']]);
                $containedRewardItemEntity->setItem($itemEntity);
                $containedRewardItemEntity->setCount($rewardItem['count']);
                $containedRewardItemEntity->setQuantity($rewardItem['quantity']);
                $containedRewardItemEntity->setAttributes($rewardItem['attributes']);
                $barterEntity->addRewardItem($containedRewardItemEntity);
                $this->em->persist($containedRewardItemEntity);
                unset($containedRewardItemEntity);
            }
            $this->em->persist($barterEntity);
        }
        $this->em->flush();
        $progressBar->finish();
        $io->success('Barters imported.');

        return Command::SUCCESS;
    }
}
