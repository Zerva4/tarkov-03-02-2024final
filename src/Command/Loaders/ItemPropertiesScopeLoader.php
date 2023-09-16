<?php

declare(strict_types=1);

namespace App\Command\Loaders;

use App\Interfaces\Item\ItemPropertiesScopeInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesScopeLoader
{
    public function load(
        EntityManagerInterface $em,
        ItemPropertiesScopeInterface $entityProperties,
        array $arrayProperties,
        string $locale = '%app.default_locale%'
    ): ItemPropertiesScopeInterface
    {
        $entityProperties
            ->setErgonomics($arrayProperties['ergonomics'] ?? 0)
            ->setSightModes($arrayProperties['sightModes'] ?? [])
            ->setSightingRange($arrayProperties['sightingRange'] ?? 0)
            ->setRecoilModifier($arrayProperties['recoilModifier'] ?? 0)
            ->setZoomLevels($arrayProperties['zoomLevels'] ?? [])
            // todo: ItemSlots[]
        ;

        return $entityProperties;
    }
}