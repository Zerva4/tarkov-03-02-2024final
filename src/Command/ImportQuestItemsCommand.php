<?php

namespace App\Command;

use App\Entity\QuestItem;
use App\Interfaces\ItemInterface;
use App\Interfaces\QuestItemInterface;
use Doctrine\ORM\EntityManagerInterface;
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
    protected static array $headers = ['Content-Type: application/json'];
    private ?EntityManagerInterface $em = null;
    protected string $storageDir;

    public function __construct(EntityManagerInterface $em, KernelInterface $kernel) {
        parent::__construct();
        $this->em = $em;
        $this->storageDir = $kernel->getProjectDir().'/public/storage/images/quests-items/';
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

        $data = @file_get_contents('https://api.tarkov.dev/graphql', false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => self::$headers,
                'content' => json_encode(['query' => $query]),
            ]
        ]));

        $questItems = (json_decode($data, true)['data']['questItems']);
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
                $questItemEntity->translate($lang, false)->setTitle($item['name']);
                $questItemEntity->translate($lang, false)->setShortTitle($item['shortName']);
                $questItemEntity->translate($lang, false)->setDescription($item['description']);
            } else {
                /** @var ItemInterface $mapEntity */
                $questItemEntity = new QuestItem($lang);
                $questItemEntity->setDefaultLocale($lang);
                $questItemEntity->translate($lang, false)->setTitle($item['name']);
                $questItemEntity->translate($lang, false)->setShortTitle($item['shortName']);
                $questItemEntity->translate($lang, false)->setDescription($item['description']);
                $questItemEntity->setApiId($item['id']);


            }

            // Download file
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
