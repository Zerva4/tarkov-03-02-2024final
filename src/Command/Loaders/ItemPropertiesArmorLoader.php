<?php

namespace App\Command\Loaders;

use App\Entity\Item\ItemMaterial;
use App\Interfaces\Item\ItemPropertiesArmorInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesArmorLoader
{
    public function load(
        EntityManagerInterface $em,
        ItemPropertiesArmorInterface $entityProperties,
        array $arrayProperties,
        string $locale = '%app.default_locale%'
    ): ItemPropertiesArmorInterface
    {
        $entityMaterial = null;
        $materialRepository = $em->getRepository(ItemMaterial::class);

        if (isset($arrayProperties['defaultAmmo']))
            $entityMaterial = $materialRepository->findOneBy(['apiId' => $arrayProperties['material']['id']]);

        $entityProperties
            ->setClass($arrayProperties['class'])
            ->setDurability($arrayProperties['durability'])
            ->setRepairCost($arrayProperties['repairCost'])
            ->setSpeedPenalty($arrayProperties['speedPenalty'])
            ->setTurnPenalty($arrayProperties['turnPenalty'])
            ->setErgoPenalty($arrayProperties['ergoPenalty'])
            ->setZones($arrayProperties['zones'])
            ->setArmorType($arrayProperties['armorType'])
            ->setBluntThroughput($arrayProperties['bluntThroughput'])
            ->setMaterial($entityMaterial)
        ;

        return $entityProperties;
    }
}