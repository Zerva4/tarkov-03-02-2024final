<?php

namespace App\Command\Loaders;

use App\Entity\Item\ItemMaterial;
use App\Interfaces\Item\ItemPropertiesHelmetInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesHelmetLoader
{
    public function load(
        EntityManagerInterface $em,
        ItemPropertiesHelmetInterface $entityProperties,
        array $arrayProperties,
        string $locale = '%app.default_locale%'
    ): ItemPropertiesHelmetInterface
    {
        $entityMaterial = null;
        $materialRepository = $em->getRepository(ItemMaterial::class);

        if (isset($arrayProperties['defaultAmmo']))
            $entityMaterial = $materialRepository->findOneBy(['apiId' => $arrayProperties['material']['id']]);

        $entityProperties
            ->setClass($arrayProperties['class'] ?? 0)
            ->setDurability($arrayProperties['durability'] ?? 0)
            ->setRepairCost($arrayProperties['repairCost'] ?? 0)
            ->setSpeedPenalty($arrayProperties['speedPenalty'] ?? 0)
            ->setTurnPenalty($arrayProperties['turnPenalty'] ?? 0)
            ->setErgoPenalty($arrayProperties['ergoPenalty'] ?? 0)
            ->setHeadZones($arrayProperties['headZones'] ?? [])
            ->setDeafening($arrayProperties['deafening'] ?? '')
            ->setBlockHeadset($arrayProperties['blocksHeadset']  ?? false)
            ->setBlindnessProtection($arrayProperties['blindnessProtection'] ?? 0)
            ->setRicochetX($arrayProperties['ricochetX'] ?? 0)
            ->setRicochetY($arrayProperties['ricochetY'] ?? 0)
            ->setRicochetZ($arrayProperties['ricochetZ'] ?? 0)
            ->setArmorType($arrayProperties['armorType'] ?? 0)
            ->setBluntThroughput($arrayProperties['bluntThroughput'] ?? 0)
            ->setMaterial($entityMaterial)
        ;

        return $entityProperties;
    }
}