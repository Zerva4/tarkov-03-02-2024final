<?php

namespace App\Command\Loaders;

use App\Entity\Item\ItemMaterial;
use App\Interfaces\Item\ItemPropertiesGlassesInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesGlassesLoader
{
    public function load(
        EntityManagerInterface $em,
        ItemPropertiesGlassesInterface $entityProperties,
        array $arrayProperties,
        string $locale = '%app.default_locale%'
    ): ItemPropertiesGlassesInterface
    {
        $entityMaterial = null;
        $materialRepository = $em->getRepository(ItemMaterial::class);

        if (isset($arrayProperties['defaultAmmo']))
            $entityMaterial = $materialRepository->findOneBy(['apiId' => $arrayProperties['material']['id']]);

        $entityProperties
            ->setClass($arrayProperties['class'] ?? 0)
            ->setDurability($arrayProperties['durability'] ?? 0)
            ->setRepairCost($arrayProperties['repairCost'] ?? 0)
            ->setBlindnessProtection($arrayProperties['blindnessProtection'] ?? 0)
            ->setBluntThroughput($arrayProperties['bluntThroughput'] ?? 0)
            ->setMaterial($entityMaterial)
        ;

        return $entityProperties;
    }
}