<?php

namespace App\Command;

use App\Entity\ItemMaterial;
use App\Interfaces\ItemMaterialInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:import:items-materials',
    description: 'Import or update items materials from https://tarkov.dev./api',
)]
class ImportItemsMaterialsCommand extends Command
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
            ->setDescription('This command allows you to import or update items materials from https://tarkov.dev./api')
            ->addOption('lang', 'l', InputArgument::OPTIONAL, 'Language', default: 'ru')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $lang = $input->getOption('lang');

        $query = <<< GRAPHQL
        {
            armorMaterials(lang: {$lang}) {
                id
                name
                destructibility
                minRepairDegradation
                maxRepairDegradation
                explosionDestructibility
                minRepairKitDegradation
                maxRepairKitDegradation
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
        $materials = (json_decode($data, true)['data']['armorMaterials']);
        if (null === $materials) {
            $io->warning('Nothing to import or update.');
        }

        $progressBar = new ProgressBar($output, count($materials));
        $progressBar->advance(0);

        foreach ($materials as $material) {
            $progressBar->advance();
            $traderRepository = $this->em->getRepository(ItemMaterial::class);
            $materialEntity = $traderRepository->findOneBy(['apiId' => $material['id']]);

            if ($materialEntity instanceof ItemMaterial) {
                $materialEntity->setDefaultLocale($lang);
                $materialEntity->translate($lang, false)->setTitle($material['name']);
            } else {
                /** @var ItemMaterialInterface $traderEntity */
                $materialEntity = new ItemMaterial();
                $materialEntity->setDefaultLocale($lang);
                $materialEntity->translate($lang, false)->setTitle($material['name']);
                $materialEntity->setApiId($material['id']);
                $materialEntity->setPublished(true);
            }

            $materialEntity
                ->setDestructibility($material['destructibility'])
                ->setMinRepairDegradation($material['minRepairDegradation'])
                ->setMaxRepairDegradation($material['maxRepairDegradation'])
                ->setExplosionDestructibility($material['explosionDestructibility'])
                ->setMinRepairKitDegradation($material['minRepairKitDegradation'])
                ->setMaxRepairKitDegradation($material['maxRepairKitDegradation'])
            ;

            $this->em->persist($materialEntity);
            $materialEntity->mergeNewTranslations();
        }
        $this->em->flush();
        $progressBar->finish();
        $io->success('Items materials imported.');

        return Command::SUCCESS;
    }
}
