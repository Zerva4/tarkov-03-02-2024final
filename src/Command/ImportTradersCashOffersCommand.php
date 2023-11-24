<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Item\Item;
use App\Entity\Quest\Quest;
use App\Entity\Trader\Trader;
use App\Entity\Trader\TraderCashOffer;
use App\Entity\Trader\TraderLevel;
use App\Interfaces\GraphQLClientInterface;
use App\Interfaces\Quest\QuestInterface;
use App\Interfaces\Trader\TraderCashOfferInterface;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\Join;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\KernelInterface;

#[AsCommand(
    name: 'app:import:traders:cash-offers',
    description: 'This command allows you to import or update traders cash offers from https://tarkov.dev./api',
)]
class ImportTradersCashOffersCommand extends Command
{
    private ?EntityManagerInterface $em = null;
    private GraphQLClientInterface $client;

    public function __construct(EntityManagerInterface $em, GraphQLClientInterface $client, KernelInterface $kernel) {
        parent::__construct();

        $this->em = $em;
        $this->client = $client;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('This command allows you to import or update cache offers from https://tarkov.dev./api')
            ->addOption('lang', 'l', InputArgument::OPTIONAL, 'Language', default: 'ru')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $lang = $input->getOption('lang');

        $query = <<< GRAPHQL
            {
                traders(lang: en) {
                    id,
                    tarkovDataId,
                    name,
                    normalizedName,
                    resetTime,
                    levels {
                      level,
                      cashOffers {
                        minTraderLevel,
                          item {
                            id
                            name
                          }
                          price
                          priceRUB
                          currency
                          currencyItem {
                            id
                            name
                          }
                          taskUnlock {
                            id
                            name
                          }
                      }
                    }
                }
            }
        GRAPHQL;

        try {
            $response = $this->client->query($query);
            $traders = $response['data']['traders'];
        } catch (Exception $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }

        if (null === $traders) {
            $io->warning('Nothing to import or update.');
        }

        if (null === $traders) {
            $io->warning('Nothing to import or update.');
        }

        $progressBar = new ProgressBar($output, count($traders));
        $progressBar->advance(0);

        $traderRepository = $this->em->getRepository(Trader::class);
        $traderLevelRepository = $this->em->getRepository(TraderLevel::class);
        $cashOffersRepository = $this->em->getRepository(TraderCashOffer::class);
        $itemRepository = $this->em->getRepository(Item::class);
        $questRepository = $this->em->getRepository(Quest::class);

        foreach ($traders as $trader) {
            $traderApiId = $trader['id'];
            foreach ($trader['levels'] as $level) {
                $traderLevel = $level['level'];
                if (count($level['cashOffers']) > 0) {
                    foreach ($level['cashOffers'] as $cashOffer) {
                        $cashOfferEntity = null;
                        $cashOfferItemId = $cashOffer['item']['id'];
                        $cashOfferCurrencyItemId = $cashOffer['currencyItem']['id'];
                        $cashOfferQuestUnlockId = (null !== $cashOffer['taskUnlock']) ? $cashOffer['taskUnlock']['id'] : null;
                        $query = $this->em->createQueryBuilder();
                        $result = $query
                            ->select('t.id AS trader, tl.id AS level, i.id AS item, ci.id AS currency, q.id AS quest')
                            ->from(Trader::class, 't')
                            ->andWhere('t.apiId = :apiId')
                            ->leftJoin(TraderLevel::class, 'tl', Join::WITH,
                                $query->expr()->andX(
                                    $query->expr()->eq('tl.trader', 't.id'),
                                    $query->expr()->eq('tl.level', ':traderLevel')
                                )
                            )
                            ->leftJoin(Item::class, 'i', Join::WITH, $query->expr()->eq('i.apiId', ':itemApiId'))
                            ->leftJoin(Item::class, 'ci', Join::WITH, $query->expr()->eq('ci.apiId', ':currencyItemApiId'))
                            ->leftJoin(Quest::class, 'q', Join::WITH, $query->expr()->eq('q.apiId', ':questId'))
                            ->setParameters([
                                'apiId' => $traderApiId,
                                'traderLevel' => $traderLevel,
                                'questId' => $cashOfferQuestUnlockId,
                                'itemApiId' => $cashOfferItemId,
                                'currencyItemApiId' => $cashOfferCurrencyItemId
                            ])
                            ->getQuery()
                            ->getOneOrNullResult();

//                        if ($cashOfferItemId === '60479fb29c15b12b9a480fb0') {
//                            dump($result);
//                        }

                        if ($result) {
                            /** @var $cashOfferEntity $cashOfferEntity */
                            $cashOfferEntity = $cashOffersRepository->findOneBy([
                                'trader' => $result['trader'],
                                'traderLevel' => $result['level'],
                                'item' => $result['item'],
                                'questUnlock' => $result['quest'],
                                'currencyItem' => $result['currency'],
                            ]);
                        }

                        if (!$cashOfferEntity instanceof TraderCashOfferInterface) {
                            $traderEntity = $traderRepository->findOneBy(['id' => $result['trader']]);
                            $traderLevelEntity = $traderLevelRepository->findOneBy(['id' => $result['level']]);
                            $itemEntity = $itemRepository->findOneBy(['id' => $result['item']]);
                            $currencyEntity = $itemRepository->findOneBy(['id' => $result['currency']]);

                            $cashOfferEntity = new TraderCashOffer();
                            $cashOfferEntity
                                ->setTrader($traderEntity)
                                ->setTraderLevel($traderLevelEntity)
                                ->setItem($itemEntity)
                                ->setCurrencyItem($currencyEntity)
                                ->setPrice($cashOffer['price'])
                                ->setPriceRUB($cashOffer['priceRUB'])
                                ->setCurrency($cashOffer['currency'])
                            ;
                            if ($result['quest']) {
                                $questEntity = $questRepository->findOneBy(['id' => $result['quest']]);
                                if ($questEntity instanceof QuestInterface) $cashOfferEntity->setQuestUnlock($questEntity);
                            }
                            $this->em->persist($cashOfferEntity);
                        }

//                        if ($result['quest']) {
//                            $questEntity = $questRepository->findOneBy(['id' => $result['quest']]);
//                            if ($questEntity instanceof QuestInterface) $cashOfferEntity->setQuestUnlock($questEntity);
//                        }
//                        $cashOfferEntity
//                            ->setPrice($cashOffer['price'])
//                            ->setPriceRUB($cashOffer['priceRUB'])
//                            ->setCurrency($cashOffer['currency']);
//                        $this->em->persist($cashOfferEntity);
                    }
                }
            }
            $progressBar->advance();
        }
        $this->em->flush();
        $progressBar->finish();
        $io->success('Traders cash offers imported.');

        return Command::SUCCESS;
    }
}
