<?php

namespace App\Command\Loaders;

use App\Interfaces\Item\ItemPropertiesWeaponModInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesWeaponModLoader
{
    public function load(
        EntityManagerInterface $em,
        ItemPropertiesWeaponModInterface $entityProperties,
        array $arrayProperties,
        string $locale = '%app.default_locale%'
    ): ItemPropertiesWeaponModInterface
    {
        $entityProperties
            ->setErgonomics($arrayProperties['ergonomics'] ?? 0)
            ->setRecoilModifier($arrayProperties['ergonomics'] ?? 0)
            ->setAccuracyModifier($arrayProperties['ergonomics'] ?? 0)
            // todo: ItemSlot[]
        ;

        return $entityProperties;
    }
}