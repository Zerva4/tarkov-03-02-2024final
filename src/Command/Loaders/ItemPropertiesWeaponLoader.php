<?php

declare(strict_types=1);

namespace App\Command\Loaders;

use App\Entity\Item\Item;
use App\Interfaces\Item\ItemInterface;
use App\Interfaces\Item\Properties\ItemPropertiesWeaponInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesWeaponLoader
{
    public function load(EntityManagerInterface $em, ItemPropertiesWeaponInterface $entityProperties, array $arrayProperties, string $locale = '%app.default_locale%'): ItemPropertiesWeaponInterface
    {
        $entityDefaultAmmo = null;
        $entityDefaultPreset = null;
        $itemRepository = $em->getRepository(Item::class);

        if (isset($arrayProperties['defaultAmmo']))
            $entityDefaultAmmo = $itemRepository->findOneBy(['apiId' => $arrayProperties['defaultAmmo']['id']]);

        if (isset($arrayProperties['defaultPreset']))
            $entityDefaultPreset = $itemRepository->findOneBy(['apiId' => $arrayProperties['defaultPreset']['id']]);

        if (isset($arrayProperties['allowedAmmo'])) {
            foreach ($arrayProperties['allowedAmmo'] as $allowedAmmo) {
                $entityAmmo = $itemRepository->findOneBy(['apiId' => $allowedAmmo['id']]);
                if ($entityAmmo instanceof ItemInterface)
                    $entityProperties->addAllowedAmmo($entityAmmo);
                unset($entityPreset);
            }
        }

        if (isset($arrayProperties['presets'])) {
            foreach ($arrayProperties['presets'] as $preset) {
                $entityPreset = $itemRepository->findOneBy(['apiId' => $preset['id']]);
                if ($entityPreset instanceof ItemInterface)
                    $entityProperties->addAllowedPreset($entityPreset);
                unset($entityPreset);
            }
        }

        $entityProperties
            ->setApiCaliber($arrayProperties['caliber'])
            ->setDefaultAmmo($entityDefaultAmmo) // todo: Check mapping
            ->setDefaultPreset($entityDefaultPreset)
            ->setEffectiveDistance($arrayProperties['effectiveDistance'])
            ->setErgonomics($arrayProperties['effectiveDistance'])
            ->setFireModes($arrayProperties['fireModes'])
            ->setFireRate($arrayProperties['fireRate'])
            ->setMaxDurability($arrayProperties['maxDurability'])
            ->setRecoilVertical($arrayProperties['recoilVertical'])
            ->setRecoilHorizontal($arrayProperties['recoilHorizontal'])
            ->setRepairCost($arrayProperties['repairCost'])
            ->setSightingRange($arrayProperties['sightingRange'])
            ->setCenterOfImpact($arrayProperties['centerOfImpact'])
            ->setDeviationCurve($arrayProperties['deviationCurve'])
            ->setRecoilDispersion($arrayProperties['recoilDispersion'])
            ->setRecoilAngle($arrayProperties['recoilAngle'])
            ->setCameraRecoil($arrayProperties['cameraRecoil'])
            ->setCameraSnap($arrayProperties['cameraSnap'])
            ->setDeviationMax($arrayProperties['deviationMax'])
            ->setConvergence($arrayProperties['convergence'])
            ->setDefaultWidth($arrayProperties['defaultWidth'])
            ->setDefaultHeight($arrayProperties['defaultHeight'])
            ->setDefaultErgonomics($arrayProperties['defaultErgonomics'])
            ->setDefaultRecoilVertical($arrayProperties['defaultRecoilVertical'])
            ->setDefaultRecoilHorizontal($arrayProperties['defaultRecoilHorizontal'])
            ->setDefaultWeight($arrayProperties['defaultWeight'])
        ;

        unset($entityDefaultAmmo, $entityDefaultPreset);

        return $entityProperties;
    }
}