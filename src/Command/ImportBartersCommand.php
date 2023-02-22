<?php

namespace App\Command;

use App\Entity\Barter;
use App\Entity\Items\ContainedItem;
use App\Entity\Items\Item;
use App\Entity\Quests\Quest;
use App\Entity\Trader;
use App\Interfaces\BarterInterface;
use App\Interfaces\GraphQLClientInterface;
use App\Interfaces\TraderInterface;
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
//        $lang = $input->getOption('lang');

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
            } else {
                /** @var BarterInterface $barterEntity */
                $barterEntity = new Barter();
//                $barterEntity->setApiId($barter['id']);
                $barterEntity->setPublished(true);
            }

            // Set trader
            /** @var TraderInterface $traderEntity */
            $traderEntity = $traderRepository->findOneBy(['apiId' => $barter['trader']['id']]);
            $barterEntity->setTrader($traderEntity);

            // Set level
            $barterEntity->setTraderLevel($barter['level']);

            // Set unlock task
//            $questEntity = null;
            if (null !== $barter['taskUnlock']) {
                $questEntity = $questRepository->findOneBy(['apiId' => $barter['taskUnlock']['id']]);
                $barterEntity->setQuestUnlock($questEntity);
            }

            // Set requiredItems
            foreach ($barter['requiredItems'] as $requiredItem) {
                $containedItemEntity = new ContainedItem();
                $itemEntity = $itemRepository->findOneBy(['apiId' => $requiredItem['item']['id']]);
                $containedItemEntity->setItem($itemEntity);
                $containedItemEntity->setCount($requiredItem['count']);
                $containedItemEntity->setQuantity($requiredItem['quantity']);
                $containedItemEntity->setAttributes($requiredItem['attributes']);
                $barterEntity->addRequiredItem($containedItemEntity);
                $this->em->persist($containedItemEntity);
            }
            unset($containedItemEntity);

            // Set requiredItems
            foreach ($barter['rewardItems'] as $rewardItem) {
                $containedItemEntity = new ContainedItem();
                $itemEntity = $itemRepository->findOneBy(['apiId' => $rewardItem['item']['id']]);
                $containedItemEntity->setItem($itemEntity);
                $containedItemEntity->setCount($rewardItem['count']);
                $containedItemEntity->setQuantity($rewardItem['quantity']);
                $containedItemEntity->setAttributes($rewardItem['attributes']);
                $barterEntity->addRewardItem($containedItemEntity);
                $this->em->persist($containedItemEntity);
            }
            unset($containedItemEntity);

            $this->em->persist($barterEntity);
        }
        $this->em->flush();
        $progressBar->finish();
        $io->success('Traders imported.');

        return Command::SUCCESS;
    }
}
