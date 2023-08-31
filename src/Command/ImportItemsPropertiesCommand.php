<?php

namespace App\Command;

use App\Entity\Item\Item;
use App\Interfaces\GraphQLClientInterface;
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
        'ItemPropertiesWeapon',
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
              presets { id }
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

        // Impart properties data
        foreach ($items as $item) {
            $progressBar->advance();
            if (empty($item['properties'])) continue;

            if (array_keys($this->item_types, $item['properties']['__typename'])) {
//                dump($item['properties']['__typename']);
                /** @var ItemInterface $itemEntity */
                $itemEntity = $itemRepository->findOneBy(['apiId' => $item['id']]);

                // Set item properties
                if (!$itemEntity instanceof ItemInterface || null === $itemEntity->getProperties()) {
                    $entityName = 'App\Entity\Item\\' . $item['properties']['__typename'];
                    $entityProperties = new $entityName();
                } else {
                    $entityProperties = $itemEntity->getProperties();
                }

                $entityLoaderName = 'App\Command\Loaders\\' . $item['properties']['__typename'] . 'Loader';
                $loader = new $entityLoaderName();
                $entityProperties = $loader->load($this->em, $entityProperties, $item['properties'], $lang);
                $itemEntity->setProperties($entityProperties);

                $this->em->persist($itemEntity);
                $this->em->flush();
                unset($itemEntity, $entityProperties, $loader);
            }
        }

        $progressBar->finish();
        $io->success('Properties Items imported.');

        return Command::SUCCESS;
    }
}
