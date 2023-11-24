<?php

declare(strict_types=1);

namespace App\Command\Loaders;

use App\Entity\Item\Item;
use App\Interfaces\Item\ItemInterface;
use App\Interfaces\Item\Properties\ItemPropertiesMagazineInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesMagazineLoader
{
    public function load(
        EntityManagerInterface $em,
        ItemPropertiesMagazineInterface $entityProperties,
        array $arrayProperties,
        string $locale = '%app.default_locale%'
    ): ItemPropertiesMagazineInterface
    {
        $itemRepository = $em->getRepository(Item::class);

        if (isset($arrayProperties['allowedAmmo'])) {
            foreach ($arrayProperties['allowedAmmo'] as $allowedAmmo) {
                $entityAmmo = $itemRepository->findOneBy(['apiId' => $allowedAmmo['id']]);
                if ($entityAmmo instanceof ItemInterface)
                    $entityProperties->addAllowedAmmo($entityAmmo);
                unset($entityPreset);
            }
        }

        $entityProperties
            ->setErgonomics($arrayProperties['ergonomics'] ?? 0)
            ->setRecoilModifier($arrayProperties['recoilModifier'] ?? 0)
            ->setCapacity($arrayProperties['capacity'] ?? 0)
            ->setLoadModifier($arrayProperties['loadModifier'] ?? 0)
            ->setAmmoCheckModifier($arrayProperties['ammoCheckModifier'] ?? 0)
            ->setMalfunctionChance($arrayProperties['malfunctionChance'] ?? 0)
            // todo: ItemSlot[]
        ;

        return $entityProperties;
    }
}