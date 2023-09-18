<?php

declare(strict_types=1);

namespace App\Command\Loaders;

use App\Interfaces\Item\ItemPropertiesMedKitInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesMedKitLoader
{
    public function load(
        EntityManagerInterface $em,
        ItemPropertiesMedKitInterface $entityProperties,
        array $arrayProperties,
        string $locale = '%app.default_locale%'
    ): ItemPropertiesMedKitInterface
    {
        $entityProperties
            ->setHitPoints($arrayProperties['hitpoints'] ?? 0)
            ->setUseTime($arrayProperties['useTime'] ?? 0)
            ->setMaxHealPerUse($arrayProperties['maxHealPerUse'] ?? 0)
            ->setCures($arrayProperties['cures'] ?? [])
            ->setHpCostLightBleeding($arrayProperties['hpCostLightBleeding'] ?? 0)
            ->setHpCostHeavyBleeding($arrayProperties['hpCostHeavyBleeding'] ?? 0)
        ;

        return $entityProperties;
    }
}