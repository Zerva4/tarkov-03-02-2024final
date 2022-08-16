<?php

namespace App\Command;

use App\Entity\Trader;
use App\Entity\TraderLevel;
use App\Interfaces\TraderInterface;
use App\Repository\TraderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:import:traders',
    description: 'Import or update traders from https://tarkov.dev./api',
)]
class ImportTradersCommand extends Command
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
            ->setDescription('This command allows you to import or update traders from https://tarkov.dev./api')
            ->addOption('lang', 'l', InputArgument::OPTIONAL, 'Admin login', default: 'ru')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $lang = $input->getOption('lang');
        $traders = null;
        $countTraders = 0;

        $query = <<< GRAPHQL
            {
                traders(lang: {$lang}) {
                    id,
                    name,
                    normalizedName,
                    resetTime,
                    levels {
                      level,
                      requiredPlayerLevel,
                      requiredCommerce,
                      requiredReputation,
                    }
                    currency {
                      name,
                      craftsFor {
                        id,
                        level,
                        station {
                          name
                        }
                      }
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
        $traders = (json_decode($data, true)['data']['traders']);
        if (null === $traders) {
            $io->warning('Nothing to import or update.');
        }

        $progressBar = new ProgressBar($output, count($traders));
        $progressBar->advance(1);

        foreach ($traders as $trader) {
            $progressBar->advance();
            $traderRepository = $this->em->getRepository(Trader::class);
            $traderEntity = $traderRepository->findOneBy(['apiId' => $trader['id']]);

            if ($traderEntity instanceof Trader) {
                $traderEntity->setDefaultLocale($lang);
                $traderEntity->translate($lang, false)->setCharacterType($trader['name']);
            } else {
                /** @var TraderInterface $traderEntity */
                $traderEntity = new Trader();
                $traderEntity->setDefaultLocale($lang);
                $traderEntity->translate($lang, false)->setFullName(null);
                $traderEntity->translate($lang, false)->setCharacterType($trader['name']);
                $traderEntity->setApiId($trader['id']);
                $traderEntity->setPublished(true);
            }

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
