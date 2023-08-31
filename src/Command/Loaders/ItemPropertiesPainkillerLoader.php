<?php

namespace App\Command\Loaders;

use App\Interfaces\Item\ItemPropertiesPainkillerInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesPainkillerLoader
{
    public function load(
        EntityManagerInterface $em,
        ItemPropertiesPainkillerInterface $entityProperties,
        array $arrayProperties,
        string $locale = '%app.default_locale%'
    ): ItemPropertiesPainkillerInterface
    {
        $entityProperties
            ->setUses($arrayProperties['uses'] ?? 0)
            ->setUseTime($arrayProperties['useTime'] ?? 0)
            ->setCures($arrayProperties['cures'] ?? [])
            ->setPainkillerDuration($arrayProperties['painkillerDuration'] ?? 0)
            ->setEnergyImpact($arrayProperties['energyImpact'] ?? 0)
            ->setHydrationImpact($arrayProperties['hydrationImpact'] ?? 0)
        ;

        return $entityProperties;
    }
}