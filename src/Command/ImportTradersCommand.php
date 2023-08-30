<?php

namespace App\Command;

use App\Entity\Trader\Trader;
use App\Entity\Trader\TraderLevel;
use App\Interfaces\GraphQLClientInterface;
use App\Interfaces\Trader\TraderInterface;
use Doctrine\Common\Collections\ArrayCollection;
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
    name: 'app:import:traders',
    description: 'Import or update traders from https://tarkov.dev./api',
)]
class ImportTradersCommand extends Command
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
            ->setDescription('This command allows you to import or update traders from https://tarkov.dev./api')
            ->addOption('lang', 'l', InputArgument::OPTIONAL, 'Language', default: 'ru')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $lang = $input->getOption('lang');

        $query = <<< GRAPHQL
            {
                traders(lang: {$lang}) {
                    id,
                    tarkovDataId,
                    name,
                    normalizedName,
                    resetTime,
                    currency {
                        id
                        name
                    }
                    discount
                    levels {
                      level,
                      requiredPlayerLevel,
                      requiredCommerce,
                      requiredReputation,
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

        $progressBar = new ProgressBar($output, count($traders));
        $progressBar->advance(0);

        foreach ($traders as $trader) {
            $order = (null !== $trader['tarkovDataId']) ? $trader['tarkovDataId'] : -1;
            $progressBar->advance();
            $traderRepository = $this->em->getRepository(Trader::class);
            $traderEntity = $traderRepository->findOneBy(['apiId' => $trader['id']]);

            if ($traderEntity instanceof Trader) {
                $traderEntity->setDefaultLocale($lang);
                $traderEntity->translate($lang, false)->setShortName($trader['name']);
                $traderEntity->setPosition($order);
            } else {
                /** @var TraderInterface $traderEntity */
                $traderEntity = new Trader();
                $traderEntity->setDefaultLocale($lang);
                $traderEntity->setPosition($order);
                $traderEntity->translate($lang, false)->setFullName(null);
                $traderEntity->translate($lang, false)->setShortName($trader['name']);
                $traderEntity->setApiId($trader['id']);
                $traderEntity->setPublished(true);
            }
            $resetTime = new \DateTime($trader['resetTime']);
            $traderEntity->setResetTime($resetTime);

            // Set levels
            if (count($trader['levels']) > 0) {
                $levelsEntities = new ArrayCollection();
                foreach ($trader['levels'] as $level) {
                    $levelEntity = new TraderLevel($lang);
                    $levelEntity
                        ->setLevel($level['level'])
                        ->setRequiredPlayerLevel($level['requiredPlayerLevel'])
                        ->setRequiredReputation($level['requiredReputation'])
                        ->setRequiredSales($level['requiredCommerce'])
                        ->setTrader($traderEntity)
                    ;
                    $this->em->persist($levelEntity);
                    $levelsEntities->add($levelEntity);
                }
                $traderEntity->setLevels($levelsEntities);
            }
            $traderEntity->setSlug($trader['normalizedName']);
            $this->em->persist($traderEntity);
            $traderEntity->mergeNewTranslations();
        }
        $this->em->flush();
        $progressBar->finish();
        $io->success('Traders imported.');

        return Command::SUCCESS;
    }
}
