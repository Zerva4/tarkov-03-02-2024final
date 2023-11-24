<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Quest\QuestItem;
use App\Interfaces\GraphQLClientInterface;
use App\Interfaces\Item\ItemInterface;
use App\Interfaces\Quest\QuestItemInterface;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Imagick;
use ImagickException;
use ImagickPixel;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\KernelInterface;

#[AsCommand(
    name: 'app:import:quests-items',
    description: 'Import or update quest items from https://tarkov.dev./api',
)]
class ImportQuestItemsCommand extends Command
{
    private EntityManagerInterface $em;
    private GraphQLClientInterface $client;
    protected string $storageDir;

    public function __construct(EntityManagerInterface $em, GraphQLClientInterface $client, KernelInterface $kernel) {
        parent::__construct();
        $this->em = $em;
        $this->client = $client;
        $this->storageDir = $kernel->getContainer()->getParameter('app.quests_items.images.path') . '/';
    }

    protected function configure(): void
    {
        $this
            ->setDescription('This command allows you to import or update quests items from https://tarkov.dev./api')
            ->addOption('lang', 'l', InputArgument::OPTIONAL, 'Language', default: 'ru')
        ;
    }

    /**
     * @throws ImagickException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $lang = $input->getOption('lang');

        $query = <<< GRAPHQL
            query {
              questItems(lang: $lang) {
                id
                name
                shortName
                description
                normalizedName
                width
                height
                iconLink
                gridImageLink
                baseImageLink
                inspectImageLink
                image512pxLink
                image8xLink
              }
            }
        GRAPHQL;

        try {
            $response = $this->client->query($query);
            $questItems = $response['data']['questItems'];
        } catch (Exception $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }

        if (null === $questItems) {
            $io->warning('Nothing to import or update.');
        }

        $progressBar = new ProgressBar($output, count($questItems));
        $progressBar->advance(0);
        $questItemRepository = $this->em->getRepository(QuestItem::class);

        foreach ($questItems as $item) {
            $questItemEntity = $questItemRepository->findOneBy(['apiId' => $item['id']]);

            if ($questItemEntity instanceof QuestItemInterface) {
                $questItemEntity->setDefaultLocale($lang);
                $questItemEntity->setName($item['name']);
                $questItemEntity->setShortName($item['shortName']);
                $questItemEntity->setDescription($item['description']);
            } else {
                /** @var ItemInterface $mapEntity */
                $questItemEntity = new QuestItem($lang);
                $questItemEntity->setDefaultLocale($lang);
                $questItemEntity->setName($item['name']);
                $questItemEntity->setShortName($item['shortName']);
                $questItemEntity->setDescription($item['description']);
                $questItemEntity->setApiId($item['id']);
            }

            // Download file
            @unlink($this->storageDir.'*.webp');
            if (!$questItemEntity->getImageFile()) {
                $curlHandle = curl_init($item['image512pxLink']);
                $fileName = basename($item['image512pxLink']);
                $tmpFileName = $this->storageDir . $fileName;
                $fp = fopen($tmpFileName, 'wb');
                curl_setopt($curlHandle, CURLOPT_FILE, $fp);
                curl_setopt($curlHandle, CURLOPT_HEADER, 0);
                curl_exec($curlHandle);
                curl_close($curlHandle);
                fclose($fp);

                // Convert to png
                $saveFileName = explode('-', $fileName, 2)[0] . '.png';
                $saveFilePath = $this->storageDir . $saveFileName;
                $im = new Imagick();
                $im->pingImage($tmpFileName);
                $im->readImage($tmpFileName);
                $im->setImageFormat('png');
                $im->setBackgroundColor(new ImagickPixel('transparent'));
                $im->writeImage($saveFilePath);
                unlink($tmpFileName);

                $questItemEntity->setImageName(explode('-', $fileName, 2)[0] . '.png');
            }

            // Set another params
            $questItemEntity->setPublished(true)
                ->setWidth($item['width'])
                ->setHeight($item['height'])
                ->setSlug($item['normalizedName'])
                ->mergeNewTranslations()
            ;
            $this->em->persist($questItemEntity);

            $progressBar->advance();
            $this->em->flush();
        }

        $progressBar->finish();
        $io->success('Quests items imported.');

        return Command::SUCCESS;
    }
}
