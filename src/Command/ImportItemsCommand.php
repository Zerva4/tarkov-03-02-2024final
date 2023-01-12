<?php

namespace App\Command;

use App\Entity\Items\Item;
use App\Entity\Quests\Quest;
use App\Interfaces\GraphqlClientInterface;
use App\Interfaces\ItemInterface;
use App\Interfaces\QuestInterface;
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
    name: 'app:import:items',
    description: 'Import or update items from https://tarkov.dev./api',
)]
class ImportItemsCommand extends Command
{
    private EntityManagerInterface $em;
    private GraphqlClientInterface $client;
    protected string $storageDir;

    public function __construct(EntityManagerInterface $em, GraphqlClientInterface $client, KernelInterface $kernel) {
        parent::__construct();

        $this->em = $em;
        $this->client = $client;
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
                  ... Ammo
                  ... Armor
                  ... Backpack
                  ... Barrel
                  ... ChestRig
                  ... FoodDrink
                  ... Glasses
                  ... Helmet
                  ... Key
                  ... Magazine
                  ... MedicalItem
                  ... MedKit
                  ... Melee
                  ... NightVision
                  ... Painkiller
                  ... Scope
                  ... SurgicalKit
                  ... Grenade
                  ... Weapon
                  ... WeaponMod
                }
                accuracyModifier,
                recoilModifier,
                ergonomicsModifier,
                hasGrid,
                blocksHeadphones,
                receivedFromTasks {
                  id, name
                },
                usedInTasks {
                  id, name
                }
                weight,
                velocity,
                loudness,
                bartersFor {
                  id,
                  trader {
                    name
                  },
                  level
                }
              }
            }
            
            fragment Ammo on ItemPropertiesAmmo {
              caliber
              stackMaxSize
              tracer
              tracerColor
              projectileCount
              damage
              armorDamage
              fragmentationChance
              ricochetChance
              penetrationChance
              penetrationPower
              accuracyModifier
              recoilModifier
              initialSpeed
              lightBleedModifier
              heavyBleedModifier
              durabilityBurnFactor
              heatFactor
            }
            
            fragment Armor on ItemPropertiesArmor {
              class
              durability
              repairCost
              speedPenalty
              turnPenalty
              ergoPenalty
              zones
              material {
                __typename
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
            
            # fragment ArmorMaterial on ItemPropertiesArmorMaterial {
            #   id
            #   name
            #   destructibility
            #   minRepairDegradation
            #   maxRepairDegradation
            #   explosionDestructibility
            #   minRepairKitDegradation
            #   maxRepairKitDegradation
            # }
            
            fragment Backpack on ItemPropertiesBackpack {
              capacity
            }
            
            fragment Barrel on ItemPropertiesBarrel {
              ergonomics
              recoilModifier
              centerOfImpact
              deviationCurve
              deviationMax
            }
            
            fragment ChestRig on ItemPropertiesChestRig {
              class
              durability
              repairCost
              speedPenalty
              turnPenalty
              ergoPenalty
              zones
              material {
                __typename
              }
              capacity
            }
            
            fragment FoodDrink on ItemPropertiesFoodDrink {
              energy
              hydration
              units
              stimEffects {
                type
                chance
                delay
                duration
                value
                percent
                skillName
              }
            }
            
            fragment Glasses on ItemPropertiesGlasses {
              class
              durability
              repairCost
              blindnessProtection
              material {
                __typename
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
            
            fragment Grenade on ItemPropertiesGrenade {
              type,
              fuse,
              minExplosionDistance,
              maxExplosionDistance,
              fragments,
              contusionRadius
            }
            
            fragment Helmet on ItemPropertiesHelmet {
              class
              durability
              repairCost
              speedPenalty
              turnPenalty
              ergoPenalty
              headZones
              material {
                __typename
                id
                name
                destructibility
                minRepairDegradation
                maxRepairDegradation
                explosionDestructibility
                minRepairKitDegradation
                maxRepairKitDegradation
              }
              deafening
              blocksHeadset
              blindnessProtection
              ricochetX
              ricochetY
              ricochetZ
            }
            
            fragment Key on ItemPropertiesKey {
              uses
            }
            
            fragment Magazine on ItemPropertiesMagazine {
              ergonomics
              recoilModifier
              capacity
              loadModifier
              ammoCheckModifier
              malfunctionChance
              allowedAmmo {
                id
              }
            }
            
            fragment MedicalItem on ItemPropertiesMedicalItem {
              uses
              useTime
              cures
            }
            
            fragment MedKit on ItemPropertiesMedKit {
              hitpoints
              useTime
              maxHealPerUse
              cures
              hpCostLightBleeding
              hpCostHeavyBleeding
            }
            
            fragment Melee on ItemPropertiesMelee {
              slashDamage
              stabDamage
              hitRadius
            }
            
            fragment NightVision on ItemPropertiesNightVision {
              intensity
              noiseIntensity
              noiseScale
              diffuseIntensity
            }
            
            fragment Painkiller on ItemPropertiesPainkiller {
              uses
              useTime
              cures
              painkillerDuration
              energyImpact
              hydrationImpact
            }
            
            fragment Scope on ItemPropertiesScope{
              ergonomics
              sightModes
              sightingRange
              recoilModifier
              zoomLevels
            }
            
            fragment SurgicalKit on ItemPropertiesSurgicalKit {
              uses
              useTime
              cures
              minLimbHealth
              maxLimbHealth
            }
            
            fragment Weapon on ItemPropertiesWeapon {
                caliber
              defaultAmmo {
                id
              }
              effectiveDistance
              ergonomics
              fireModes
              fireRate
              maxDurability
              recoilVertical
              recoilHorizontal
              repairCost
              sightingRange
              centerOfImpact
              deviationCurve
              deviationMax
              defaultWidth
              defaultHeight
              defaultErgonomics
              defaultRecoilVertical
              defaultRecoilHorizontal
              defaultWeight
              defaultPreset {
                id
              }
              allowedAmmo {
                id
              }
            }
            
            fragment WeaponMod on ItemPropertiesWeaponMod {
              ergonomics
              recoilModifier
              accuracyModifier
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
        $questRepository = $this->em->getRepository(Quest::class);

        foreach ($items as $item) {
            $itemEntity = $itemRepository->findOneBy(['apiId' => $item['id']]);

            if ($itemEntity instanceof ItemInterface) {
                $itemEntity->setDefaultLocale($lang);
                $itemEntity->translate($lang, false)->setTitle($item['name']);
            } else {
                $typeName = (isset($item['properties'])) ? $typeName = $item['properties']['__typename'] : 'ItemDefaultProperty';
                /** @var ItemInterface $mapEntity */
                $itemEntity = new Item($lang);
                $itemEntity->setDefaultLocale($lang);
                $itemEntity->translate($lang, false)->setTitle($item['name']);
                $itemEntity->setApiId($item['id']);
                $itemEntity->setType($typeName);
            }

            // Download file
            @unlink($this->storageDir.'*.webp');
            if (!$itemEntity->getImageFile()) {
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

                $itemEntity->setImageName(explode('-', $fileName, 2)[0] . '.png');
            }

            // Set another params
            $hasGrid = (null !== $item['hasGrid']) ? $item['hasGrid'] : false;
            $blocksHeadphones = (null !== $item['blocksHeadphones']) ? $item['blocksHeadphones'] : false;
            $itemEntity->setPublished(true)
                ->setSlug($item['normalizedName'])
                ->setTypes($item['types'])
                ->setBasePrice($item['basePrice'])
                ->setWidth($item['width'])
                ->setHeight($item['height'])
                ->setBackgroundColor($item['backgroundColor'])
                ->setAccuracyModifier($item['accuracyModifier'])
                ->setRecoilModifier($item['recoilModifier'])
                ->setErgonomicsModifier($item['recoilModifier'])
                ->setHasGrid($hasGrid)
                ->setBlocksHeadphones($blocksHeadphones)
                ->setWeight($item['weight'])
                ->setVelocity($item['velocity'])
                ->setLoudness($item['loudness'])
                ->mergeNewTranslations()
            ;
            $this->em->persist($itemEntity);

            // Set received from quests
            if (is_array($item['receivedFromTasks']) && count($item['receivedFromTasks']) > 0) {
                foreach ($item['receivedFromTasks'] as $key => $receivedFromQuest) {
                    $questEntity = $questRepository->findOneBy(['apiId' => $receivedFromQuest['id']]);
                    if ($questEntity instanceof QuestInterface) {
                        $itemEntity->addReceivedFromQuest($questEntity);
                    }
                }
            }

            // Set used in quest
            if (is_array($item['usedInTasks']) && count($item['usedInTasks']) > 0) {
                foreach ($item['usedInTasks'] as $usedInTask) {
                    $questEntity = $questRepository->findOneBy(['apiId' => $usedInTask['id']]);
                    if ($questEntity instanceof QuestInterface) {
                        $itemEntity->addUsedInQuest($questEntity);
                    }
                }
            }

            $progressBar->advance();
            $this->em->flush();
        }

        $progressBar->finish();
        $io->success('Items imported.');

        return Command::SUCCESS;
    }
}
