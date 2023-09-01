<?php

namespace App\Command;

use App\Entity\Boss;
use App\Entity\BossHealth;
use App\Interfaces\BossInterface;
use App\Interfaces\GraphQLClientInterface;
use App\Interfaces\MapInterface;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:import:bosses',
    description: 'Import or update bosses from https://tarkov.dev./api',
)]
class ImportBossesCommand extends Command
{
    private EntityManagerInterface $em;
    private GraphQLClientInterface $client;

    public function __construct(EntityManagerInterface $em, GraphQLClientInterface $client) {
        parent::__construct();

        $this->em = $em;
        $this->client = $client;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('This command allows you to import or update bosses from https://tarkov.dev./api')
            ->addOption('lang', 'l', InputArgument::OPTIONAL, 'Language', default: 'ru')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $lang = $input->getOption('lang');

        $query = <<< GRAPHQL
            {
                bosses(lang: {$lang}) {
                    __typename
                    name
                    normalizedName
                    equipment {
                      item {
                        id
                        name
                      }
                      quantity
                      attributes {
                        __typename
                        name
                        value
                      }
                    }
                    health {
                      id
                      max
                      bodyPart
                    }
                    items { id }
                }
            }
        GRAPHQL;

        try {
            $response = $this->client->query($query);
            $bosses = $response['data']['bosses'];
        } catch (Exception $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }

        if (null === $bosses) {
            $io->warning('Nothing to import or update.');
        }

        $progressBar = new ProgressBar($output, count($bosses));
        $progressBar->advance(0);
        $bossRepository = $this->em->getRepository(Boss::class);

        foreach ($bosses as $boss) {
            $progressBar->advance();
            $bossEntity = $bossRepository->findOneBy(['slug' => $boss['normalizedName']]);

            if ($bossEntity instanceof BossInterface) {
                $bossEntity->setDefaultLocale($lang);
                $bossEntity->translate($lang, false)->setName($boss['name']);
            } else {
                /** @var MapInterface $mapEntity */
                $bossEntity = new Boss($lang);
                $bossEntity->setDefaultLocale($lang);
                /** TranslationInterface */
                $bossEntity->translate($lang, false)->setName($boss['name']);
            }

            $bossEntity
                ->setPublished(true)
                ->setSlug($boss['normalizedName'])
            ;

            // Added health
            $bossHealthRepository = $this->em->getRepository(BossHealth::class);
            if (null !== $boss['health']) {
                foreach ($boss['health'] as $health) {
                    $bossHealthEntity = null;

                    if (null !== $bossEntity->getId()) {
                        $bossHealthEntity = $bossHealthRepository->findByByNameAndBossId($bossEntity->getId(), $health['id']);
                    }

                    if (!$bossHealthEntity) {
                        $bossHealthEntity = new BossHealth();
                        $bossHealthEntity
                            ->setPublished(true)
                            ->setName($health['id'])
                            ->setMax($health['max'])
                            ->setBoss($bossEntity);
                        $this->em->persist($bossHealthEntity);
                        $bossEntity->addHealth($bossHealthEntity);
                        unset($bossHealthEntity);
                    }
                }
            }

            $this->em->persist($bossEntity);
            $bossEntity->mergeNewTranslations();
        }

        // todo: import equipments and items

        $this->em->flush();
        $progressBar->finish();

        $io->success('Maps imported.');

        return Command::SUCCESS;
    }
}
