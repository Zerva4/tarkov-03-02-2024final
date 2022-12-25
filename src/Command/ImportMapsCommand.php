<?php

namespace App\Command;

use App\Entity\Map;
use App\Interfaces\MapInterface;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:import:maps',
    description: 'Import or update maps from https://tarkov.dev./api',
)]
class ImportMapsCommand extends Command
{
    protected static array $headers = ['Content-Type: application/json'];
    protected static array $slugs = [
        'bigmap' => 'customs',
        'factory4_day' => 'factory',
        'Interchange' => 'upshot',
        'Lighthouse' => 'lighthouse',
        'factory4_night' => 'night-factory',
        'RezervBase' => 'reserve',
        'Shoreline' => 'coast',
        'laboratory' => 'lab',
        'Woods' => 'forest',
    ];

    private ?EntityManagerInterface $em = null;

    public function __construct(EntityManagerInterface $em) {
        parent::__construct();

        $this->em = $em;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('This command allows you to import or update maps from https://tarkov.dev./api')
            ->addOption('lang', 'l', InputArgument::OPTIONAL, 'Language', default: 'ru')
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
                maps(lang: $lang) {
                    id,
                    name,
                    nameId,
                    wiki,
                    description,
                    enemies,
                    raidDuration,
                    players
                    bosses {
                        name,
                        spawnChance,
                        spawnTime,
                        spawnTimeRandom,
                        spawnTrigger,
                        spawnLocations {
                            name, chance
                        }
                        escorts {
                            name,
                            amount {
                                count, chance
                            }
                        }
                    }
                }
            }
        GRAPHQL;

        try {
            $data = file_get_contents('https://api.tarkov.dev/graphql', false, stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => self::$headers,
                    'content' => json_encode(['query' => $query]),
                ]
            ]));
        } catch (Exception $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }

        $maps = (json_decode($data, true)['data']['maps']);
        if (null === $maps) {
            $io->warning('Nothing to import or update.');
        }

        $progressBar = new ProgressBar($output, count($maps));
        $progressBar->advance(0);
        $mapRepository = $this->em->getRepository(Map::class);

        foreach ($maps as $map) {
            list($minPlayers, $maxPlayers) = explode('-', $map['players'], 2);
            if ($map['nameId'] === 'factory4_night') continue;
            $progressBar->advance();
            $mapEntity = $mapRepository->findOneBy(['apiId' => $map['id']]);

            if ($mapEntity instanceof Map) {
                $mapEntity->setDefaultLocale($lang);
                $mapEntity->translate($lang, false)->setTitle($map['name']);
                $mapEntity->translate($lang, false)->setDescription($map['description']);
            } else {
                /** @var MapInterface $mapEntity */
                $mapEntity = new Map($lang);
                $mapEntity->setDefaultLocale($lang);
                $mapEntity->translate($lang, false)->setTitle($map['name']);
                $mapEntity->translate($lang, false)->setDescription($map['description']);
            }
            $duration = (new DateTime())->setTimestamp((int)$map['raidDuration']*60);
            $mapEntity
                ->setApiId($map['id'])
                ->setPublished(true)
                ->setSlug(self::$slugs[$map['nameId']])
                ->setRaidDuration($duration)
                ->setMinPlayersNumber((int)$minPlayers)
                ->setMaxPlayersNumber((int)$maxPlayers)
            ;
            $this->em->persist($mapEntity);
            $mapEntity->mergeNewTranslations();
        }
        $this->em->flush();
        $progressBar->finish();
        $io->success('Maps imported.');

        return Command::SUCCESS;
    }
}
