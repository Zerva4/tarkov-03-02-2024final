<?php

declare(strict_types=1);

namespace App\Command\Loaders;

use App\Interfaces\Item\ItemPropertiesAmmoInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesAmmoLoader
{
    public function load(EntityManagerInterface $em, ItemPropertiesAmmoInterface $entityProperties, array $arrayProperties, string $locale = '%app.default_locale%'): ItemPropertiesAmmoInterface
    {
        $entityProperties
            ->setApiCaliber($arrayProperties['caliber'])
            ->setStackMaxSize($arrayProperties['stackMaxSize'])
            ->setTracer($arrayProperties['tracer'])
            ->setTracerColor($arrayProperties['tracerColor'])
            ->setAmmoType($arrayProperties['ammoType'] ?? '')
            ->setProjectileCount($arrayProperties['projectileCount'])
            ->setDamage($arrayProperties['damage'])
            ->setArmorDamage($arrayProperties['armorDamage'])
            ->setFragmentationChance($arrayProperties['fragmentationChance'])
            ->setRicochetChance($arrayProperties['ricochetChance'])
            ->setPenetrationChance($arrayProperties['penetrationChance'])
            ->setPenetrationPower($arrayProperties['penetrationPower'])
            ->setAccuracyModifier($arrayProperties['accuracyModifier'])
            ->setRecoilModifier($arrayProperties['recoilModifier'])
            ->setInitialSpeed($arrayProperties['initialSpeed'])
            ->setLightBleedModifier($arrayProperties['lightBleedModifier'])
            ->setHeavyBleedModifier($arrayProperties['heavyBleedModifier'])
            ->setDurabilityBurnFactor($arrayProperties['durabilityBurnFactor'])
            ->setHeatFactor($arrayProperties['heatFactor'])
            ->setStaminaBurnPerDamage($arrayProperties['staminaBurnPerDamage'])
            ->setBallisticCoefficient($arrayProperties['ballisticCoeficient'])
            ->setBulletDiameterMillimeters($arrayProperties['bulletDiameterMilimeters'])
            ->setBulletMassGrams($arrayProperties['bulletMassGrams'])
        ;
        return $entityProperties;
    }
}