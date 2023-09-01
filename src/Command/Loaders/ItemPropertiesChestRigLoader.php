<?php

declare(strict_types=1);

namespace App\Command\Loaders;

use App\Entity\Item\ItemMaterial;
use App\Interfaces\Item\ItemPropertiesChestRigInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesChestRigLoader
{
    public function load(
        EntityManagerInterface $em,
        ItemPropertiesChestRigInterface $entityProperties,
        array $arrayProperties,
        string $locale = '%app.default_locale%'
    ): ItemPropertiesChestRigInterface
    {
        $entityMaterial = null;
        $materialRepository = $em->getRepository(ItemMaterial::class);

        if (isset($arrayProperties['material']) && count($arrayProperties['material']) > 1)
            $entityMaterial = $materialRepository->findOneBy(['apiId' => $arrayProperties['material']['id']]);

        $entityProperties
            ->setClass($arrayProperties['class'] ?? 0)
            ->setDurability($arrayProperties['durability'] ?? 0)
            ->setRepairCost($arrayProperties['repairCost'] ?? 0)
            ->setSpeedPenalty($arrayProperties['speedPenalty'] ?? 0)
            ->setTurnPenalty($arrayProperties['turnPenalty'] ?? 0)
            ->setErgoPenalty($arrayProperties['ergoPenalty'] ?? 0)
            ->setZones($arrayProperties['zones'] ?? [])
            ->setCapacity($arrayProperties['capacity'] ?? 0)
            ->setArmorType($arrayProperties['armorType'] ?? '')
            ->setBluntThroughput($arrayProperties['bluntThroughput'] ?? 0)
            ->setMaterial($entityMaterial)
        ;

        return $entityProperties;
    }
}