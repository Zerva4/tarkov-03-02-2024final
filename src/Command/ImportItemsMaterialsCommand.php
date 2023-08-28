<?php

namespace App\Command;

use App\Entity\Item\ItemMaterial;
use App\Interfaces\GraphQLClientInterface;
use App\Interfaces\Item\ItemMaterialInterface;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:import:items-materials',
    description: 'Import or update items materials from https://tarkov.dev./api',
)]
class ImportItemsMaterialsCommand extends Command
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

        try {
            $response = $this->client->query($query);
            $materials = $response['data']['armorMaterials'];
        } catch (Exception $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }

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
                $materialEntity->translate($lang, false)->setName($material['name']);
            } else {
                /** @var ItemMaterialInterface $traderEntity */
                $materialEntity = new ItemMaterial();
                $materialEntity->setDefaultLocale($lang);
                $materialEntity->translate($lang, false)->setName($material['name']);
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
