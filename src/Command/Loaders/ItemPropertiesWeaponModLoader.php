<?php

declare(strict_types=1);

namespace App\Command\Loaders;

use App\Interfaces\Item\Properties\ItemPropertiesWeaponModInterface;
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
            ->setRecoilModifier($arrayProperties['recoilModifier'] ?? 0)
            ->setAccuracyModifier($arrayProperties['accuracyModifier'] ?? 0)
            // todo: ItemSlot[]
        ;

        return $entityProperties;
    }
}