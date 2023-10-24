<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Item\Item;
use App\Entity\Quest\Quest;
use App\Interfaces\GraphQLClientInterface;
use App\Interfaces\Item\ItemInterface;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Imagick;
use ImagickException;
use ImagickPixel;
use ReflectionException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\HttpOptions;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'app:import:items',
    description: 'Import or update items from https://tarkov.dev./api',
)]
class ImportItemsCommand extends Command
{
    private EntityManagerInterface $em;
    private GraphQLClientInterface $client;
    private HttpClientInterface $httpClient;
    protected string $storageDir;

    protected array $moneyArray = ['5449016a4bdc2d6f028b456f', '5696686a4bdc2da3298b456a', '569668774bdc2da2298b4568'];

    public function __construct(EntityManagerInterface $em, GraphQLClientInterface $client, HttpClientInterface $httpClient, KernelInterface $kernel)
    {
        parent::__construct();

        $this->em = $em;
        $this->client = $client;
        $this->httpClient = $httpClient;
        $this->storageDir = $kernel->getContainer()->getParameter('app.items.images.path') . '/';
    }

    protected function configure(): void
    {
        $this
            ->setDescription('This command allows you to import or update items from https://tarkov.dev./api')
            ->addOption('lang', 'l', InputArgument::OPTIONAL, 'Language', default: 'ru')
        ;
    }

    /**
     * @throws ImagickException
     * @throws ReflectionException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $lang = $input->getOption('lang');

        $query = <<< GRAPHQL
            {
            items(lang: $lang) {
                id,
                updated,
                name,
                shortName,
                normalizedName,
                basePrice,
                width, height, backgroundColor
                inspectImageLink
                image512pxLink
                types,
                properties {
                  __typename
                }
                hasGrid,
                blocksHeadphones,
                weight,
              }
            }
        GRAPHQL;

        try {
            $response = $this->client->query($query);
            $items = $response['data']['items'];
        } catch (Exception $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }

        if (null === $items) {
            $io->warning('Nothing to import or update.');
        }

        $progressBar = new ProgressBar($output, count($items));
        $progressBar->advance(0);
        $itemRepository = $this->em->getRepository(Item::class);

        // Impart base data
        foreach ($items as $key => $item) {
            $itemEntity = $itemRepository->findOneBy(['apiId' => $item['id']]);
            if ($key == 29) dump($itemEntity);

            if ($itemEntity instanceof ItemInterface) {
                $itemEntity->setDefaultLocale($lang);
                $itemEntity->setName($item['name']);
                $itemEntity->setShortName($item['shortName']);
            } else {
                $typeName = (isset($item['properties'])) ? $typeName = $item['properties']['__typename'] : 'ItemPropertiesDefault';
                /** @var ItemInterface $itemEntity */
                $itemEntity = new Item($lang);
                $itemEntity->setName($item['name']);
                $itemEntity->setShortName($item['shortName']);
                $itemEntity->setApiId($item['id']);
                $itemEntity->setTypeItem($typeName);
            }

            // Download file
            @unlink($this->storageDir.'*.webp');
            if (!$itemEntity->getImageName()) {
                $imageName =$this->convertImage($item['image512pxLink']);
                $itemEntity->setImageName($imageName);
            }

            // Fetch description
            $itemArray = $this->fetchJson($item['id'], $lang, $this->httpClient);
            if (is_array($itemArray))
                $itemEntity->setDescription($itemArray['locale']['Description']);

            // Set base params
            $hasGrid = (null !== $item['hasGrid']) ? $item['hasGrid'] : false;
            if ($this->isMoney($item['id'])) $item['types'][] = 'money';
            $itemEntity->setPublished(true)
                ->setSlug($item['normalizedName'])
                ->setTypes($item['types'])
                ->setBasePrice($item['basePrice'])
                ->setWidth($item['width'])
                ->setHeight($item['height'])
                ->setBackgroundColor($item['backgroundColor'])
                ->setHasGrid($hasGrid)
                ->setWeight($item['weight'])
            ;
            $this->em->persist($itemEntity);
            $itemEntity->mergeNewTranslations();

            // Set received from quests
//            if (is_array($item['receivedFromTasks']) && count($item['receivedFromTasks']) > 0) {
//                foreach ($item['receivedFromTasks'] as $key => $receivedFromQuest) {
//                    $questEntity = $questRepository->findOneBy(['apiId' => $receivedFromQuest['id']]);
//                    if ($questEntity instanceof QuestInterface) {
//                        $containedItemEntity = new ContainedItem();
//                        $containedItemEntity->addReceivedFromQuest($questEntity);
//                        $this->em->persist($containedItemEntity);
//                        unset($containedItemEntity);
//                    }
//                }
//            }

            // Set used in quest
//            if (is_array($item['usedInTasks']) && count($item['usedInTasks']) > 0) {
//                foreach ($item['usedInTasks'] as $usedInTask) {
//                    $questEntity = $questRepository->findOneBy(['apiId' => $usedInTask['id']]);
//                    if ($questEntity instanceof QuestInterface) {
//                        $containedItemEntity = new ContainedItem();
//                        $containedItemEntity->addUsedInQuest($questEntity);
//                        $this->em->persist($containedItemEntity);
//                        unset($containedItemEntity);
//                    }
//                }
//            }

            $progressBar->advance();
            $this->em->flush();
            unset($itemEntity);
        }

        $progressBar->finish();
        $io->success('Items imported.');

        return Command::SUCCESS;
    }

    protected function isMoney(string $apiId): bool
    {
        return in_array($apiId, $this->moneyArray);
    }

    protected function convertImage(string $url): ?string
    {
        $curlHandle = curl_init($url);
        $fileName = basename($url);
        $tmpFileName = $this->storageDir . $fileName;
        $fp = fopen($tmpFileName, 'wb');
        curl_setopt($curlHandle, CURLOPT_FILE, $fp);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_exec($curlHandle);
        curl_close($curlHandle);
        fclose($fp);

        $fhSource = fopen($tmpFileName, 'a+');
        $im = new Imagick();
        $im->readImageFile($fhSource);
        fclose($fhSource);

        $saveFileName = explode('-', $fileName, 2)[0] . '.png';
        $saveFilePath = $this->storageDir . $saveFileName;

        $fhSave = fopen($saveFilePath, 'a+');
        $im->setImageFormat('png');
        $im->setBackgroundColor(new ImagickPixel('transparent'));
        $im->writeImageFile($fhSave);
        fclose($fhSave);
        unlink($tmpFileName);

        return explode('-', $fileName, 2)[0] . '.png';
    }

    protected function fetchJson(string $apiId, string $locale, HttpClientInterface $client): ?array
    {
        $result = null;
        $variables = [
            'id' => $apiId,
            'locale' => $locale
        ];

        $options = (new HttpOptions())
            ->setQuery($variables)
            ->setHeaders([
                'Accept' => 'application/json',
                'User-Agent' => 'Symfony HTTP client'
            ])
        ;

        try {
            $request = $client
                ->request('GET', 'https://db.sp-tarkov.com/api/item', $options->toArray());
            $result = $request->toArray();
        } catch (Exception $e) {
            $result = null;
        }

        return $result;
    }
}
