<?php

namespace App\Command\Loaders;

use App\Interfaces\Item\ItemPropertiesGrenadeInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesGrenadeLoader
{
    public function load(
        EntityManagerInterface $em,
        ItemPropertiesGrenadeInterface $entityProperties,
        array $arrayProperties,
        string $locale = '%app.default_locale%'
    ): ItemPropertiesGrenadeInterface
    {
        $entityProperties
            ->setType($arrayProperties['type'] ?? '')
            ->setFuse($arrayProperties['fuse'] ?? 0)
            ->setMinExplosionDistance($arrayProperties['minExplosionDistance'] ?? 0)
            ->setMaxExplosionDistance($arrayProperties['maxExplosionDistance'] ?? 0)
            ->setFragments($arrayProperties['fragments'] ?? 0)
            ->setContusionRadius($arrayProperties['contusionRadius'] ?? 0)
        ;
        return $entityProperties;
    }
}