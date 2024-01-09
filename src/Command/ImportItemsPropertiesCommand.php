<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Item\Item;
use App\Entity\Item\ItemCaliber;
use App\Interfaces\GraphQLClientInterface;
use App\Interfaces\Item\ItemCaliberInterface;
use App\Interfaces\Item\ItemInterface;
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
    name: 'app:import:items-properties',
    description: 'Import or update properties items from https://tarkov.dev./api',
)]
class ImportItemsPropertiesCommand extends Command
{
    private array $item_types = [
        'ItemPropertiesAmmo',
        'ItemPropertiesArmor',
        'ItemPropertiesBackpack',
        'ItemPropertiesBarrel',
        'ItemPropertiesChestRig',
        'ItemPropertiesContainer',
        'ItemPropertiesFoodDrink',
        'ItemPropertiesGlasses',
        'ItemPropertiesGrenade',
        'ItemPropertiesHeadphone',
        'ItemPropertiesHelmet',
        'ItemPropertiesKey',
        'ItemPropertiesMagazine',
        'ItemPropertiesMedicalItem',
        'ItemPropertiesMedKit',
        'ItemPropertiesMelee',
        'ItemPropertiesNightVision',
        'ItemPropertiesPreset',
        'ItemPropertiesPainkiller',
        'ItemPropertiesStimulation',
        'ItemPropertiesScope',
        'ItemPropertiesSurgicalKit',
        'ItemPropertiesWeapon',
        'ItemPropertiesWeaponMod'
    ];

    private array $item_calibres = [
        'Caliber1143x23ACP' => [
            'name' => '.45 ACP',
            'slug' => '45-ACP'
        ],
        'Caliber127x55' => [
            'name' => '12.7x55',
            'slug' => '12-7x55'
        ],
        'Caliber12g' => [
            'name' => '12/70',
            'slug' => '12-70'
        ],
        'Caliber20g' => [
            'name' => '20/70',
            'slug' => '20-70'
        ],
        'Caliber23x75' => [
            'name' => '23x75',
            'slug' => '23-75'
        ],
        'Caliber26x75' => [
            'name' => '26x75',
            'slug' => '26x75'
        ],
        'Caliber366TKM' => [
            'name' => '.366 TKM',
            'slug' => '366-TKM'
        ],
        'Caliber40mmRU' => [
            'name' => '40mm',
            'slug' => '40mm'
        ],
        'Caliber40x46' => [
            'name' => '40x46',
            'slug' => '40x46'
        ],
        'Caliber46x30' => [
            'name' => '4.6x30',
            'slug' => '4-6x30'
        ],
        'Caliber545x39' => [
            'name' => '5.45x39',
            'slug' => '5-45x39'
        ],
        'Caliber556x45NATO' => [
            'name' => '5.56x45',
            'slug' => '5-56x45'
        ],
        'Caliber57x28' => [
            'name' => '5.7x28',
            'slug' => '5-7x28'
        ],
        'Caliber762x25TT' => [
            'name' => '7.62x25',
            'slug' => '7-62x25'
        ],
        'Caliber762x35' => [
            'name' => '.300 BLK',
            'slug' => '300-BLK'
        ],
        'Caliber762x39' => [
            'name' => '7.62x39',
            'slug' => '7-62x39'
        ],
        'Caliber762x51' => [
            'name' => '7.62x51',
            'slug' => '7-62x51'
        ],
        'Caliber762x54R' => [
            'name' => '7.62x54R',
            'slug' => '7-62x54R'
        ],
        'Caliber86x70' => [
            'name' => '338 LM',
            'slug' => '338-LM'
        ],
        'Caliber9x18PM' => [
            'name' => '9x18PM',
            'slug' => '9-18PM'
        ],
        'Caliber9x18PMM' => [
            'name' => '9x18PMM',
            'slug' => '9-18PMM'
        ],
        'Caliber9x19PARA' => [
            'name' => '9x19',
            'slug' => '9x19'
        ],
        'Caliber9x21' => [
            'name' => '9x21',
            'slug' => '9x21'
        ],
        'Caliber9x21M' => [
            'name' => '9x21M',
            'slug' => '9x21M'
        ],
        'Caliber9x33R' => [
            'name' => '.357 Magnum',
            'slug' => '357-Magnum'
        ],
        'Caliber9x39' => [
            'name' => '9x39',
            'slug' => '9x39'
        ],
    ];

    private EntityManagerInterface $em;
    private GraphQLClientInterface $client;

    public function __construct(EntityManagerInterface $em, GraphQLClientInterface $client)
    {
        parent::__construct();

        $this->em = $em;
        $this->client = $client;
    }
    protected function configure(): void
    {
        $this
            ->addOption('lang', 'l', InputArgument::OPTIONAL, 'Language', default: 'ru')
        ;
    }

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
                  ... Preset
                  ... Scope
                  ... Stimulator
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
              ammoType
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
              staminaBurnPerDamage
              heatFactor
              ballisticCoeficient
              bulletDiameterMilimeters
              bulletMassGrams
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
              armorType
              bluntThroughput
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
              grids {
                width
                height
              }
              speedPenalty
              turnPenalty
              ergoPenalty
            }
            
            fragment Barrel on ItemPropertiesBarrel {
              ergonomics
              recoilModifier
              centerOfImpact
              deviationCurve
              deviationMax
              slots {
                id
                name
                nameId
                required
              }
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
              grids {
                width
                height
              }
              armorType
              bluntThroughput
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
              bluntThroughput
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
              slots {
                id
                name
                nameId
                required
              }
              armorType
              bluntThroughput
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
              slots {
                id
                name
                nameId
                required
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
            
            fragment Stimulator on ItemPropertiesStim {
              useTime
              cures
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
            
            fragment Preset on ItemPropertiesPreset {
                baseItem {
                    id, name
                }
                ergonomics
                recoilVertical
                recoilHorizontal
                moa
                default
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
              slots {
                id
                name
                nameId
                required
              }
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
              recoilDispersion
              recoilAngle
              cameraRecoil
              cameraSnap
              deviationMax
              convergence
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
              slots {
                id
                name
                nameId
                required
              }
            }
            
            fragment WeaponMod on ItemPropertiesWeaponMod {
              ergonomics
              recoilModifier
              accuracyModifier
              slots {
                id
                name
                nameId
                required
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
        $itemCaliberRepository = $this->em->getRepository(ItemCaliber::class);

        // Impart properties data
        foreach ($items as $item) {
            $progressBar->advance();
            if (empty($item['properties'])) continue;

            if ($item['properties']['__typename'] === 'ItemPropertiesStim') {
                $item['properties']['__typename'] = 'ItemPropertiesStimulation';
            }

            if (array_keys($this->item_types, $item['properties']['__typename'])) {
                /** @var ItemInterface $itemEntity */
                $itemEntity = $itemRepository->findOneBy(['apiId' => $item['id']]);

                if (!$itemEntity instanceof ItemInterface) continue;

                // Set item properties
                if (count($item['properties']) > 1) {
                    if (null === $itemEntity->getProperties()) {
                        $entityName = 'App\Entity\Item\Properties\\' . $item['properties']['__typename'];
                        $entityProperties = new $entityName();
                    } else {
                        $entityProperties = $itemEntity->getProperties();
                    }

                    // Update items calibers and set to property
                    if ($item['properties']['__typename'] === 'ItemPropertiesAmmo' || $item['properties']['__typename'] === 'ItemPropertiesWeapon') {
                        /** @var ItemCaliberInterface $itemCaliberEntity */
                        if ($item['properties']['__typename'] === 'ItemPropertiesAmmo') {
                            $itemCaliberEntity = $itemCaliberRepository->findOneBy([
                                'apiId' => $item['properties']['caliber'],
                                'isAmmo' => true
                            ]);
                        } else {
                            $itemCaliberEntity = $itemCaliberRepository->findOneBy([
                                'apiId' => $item['properties']['caliber'],
                                'isAmmo' => false
                            ]);
                        }
                        $isAmmo = in_array('ammo', $item['types']);
                        $caliberId = $item['properties']['caliber'];

                        if (!$itemCaliberEntity instanceof ItemCaliberInterface) {
                            $itemCaliberEntity = new ItemCaliber($lang);
                            $itemCaliberEntity->setPublished(true);
                        }

                        $itemCaliberEntity
                            ->setPublished(true)
                            ->setIsAmmo($isAmmo)
                            ->setApiId($caliberId)
                            ->setName($this->item_calibres[$caliberId]['name'])
                            ->setSlug($this->item_calibres[$caliberId]['slug'])
                            ->mergeNewTranslations()
                        ;
                        $this->em->persist($itemCaliberEntity);
                        $this->em->flush();
                        $entityProperties->setCaliber($itemCaliberEntity);
                    }

                    $entityLoaderName = 'App\Command\Loaders\\' . $item['properties']['__typename'] . 'Loader';
                    $loader = new $entityLoaderName();
                    $entityProperties = $loader->load($this->em, $entityProperties, $item['properties'], $lang);
                    $itemEntity->setProperties($entityProperties);

                    $this->em->persist($itemEntity);
                    $this->em->flush();
                }
                unset($entityProperties, $loader);
            }
        }

        $progressBar->finish();
        $io->success('Properties Items imported.');

        return Command::SUCCESS;
    }
}
