<?php

declare(strict_types=1);

namespace App\Command\Loaders;

use App\Interfaces\Item\ItemPropertiesSurgicalKitInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesSurgicalKitLoader
{
    public function load(
        EntityManagerInterface $em,
        ItemPropertiesSurgicalKitInterface $entityProperties,
        array $arrayProperties,
        string $locale = '%app.default_locale%'
    ): ItemPropertiesSurgicalKitInterface
    {
        $entityProperties
            ->setUses($arrayProperties['uses'] ?? 0)
            ->setUseTime($arrayProperties['useTime'] ?? 0)
            ->setCures($arrayProperties['cures'] ?? [])
            ->setMinLimbHealth($arrayProperties['minLimbHealth'] ?? 0)
            ->setMaxLimbHealth($arrayProperties['maxLimbHealth'] ?? 0)
        ;

        return $entityProperties;
    }
}