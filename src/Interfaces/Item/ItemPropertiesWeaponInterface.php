<?php

declare(strict_types=1);

namespace App\Interfaces\Item;

use Doctrine\Common\Collections\Collection;

interface ItemPropertiesWeaponInterface
{
    public function getApiCaliber(): string;
    public function setApiCaliber(string $apiCaliber): ItemPropertiesWeaponInterface;
    public function getDefaultAmmo(): ?ItemInterface;
    public function setDefaultAmmo(?ItemInterface $defaultAmmo): ItemPropertiesWeaponInterface;
    public function getEffectiveDistance(): int;
    public function setEffectiveDistance(int $effectiveDistance): ItemPropertiesWeaponInterface;
    public function getErgonomics(): float;
    public function setErgonomics(float $ergonomics): ItemPropertiesWeaponInterface;
    public function getFireModes(): ?array;
    public function setFireModes(?array $fireModes): ItemPropertiesWeaponInterface;
    public function getFireRate(): int;
    public function setFireRate(int $fireRate): ItemPropertiesWeaponInterface;
    public function getMaxDurability(): int;
    public function setMaxDurability(int $maxDurability): ItemPropertiesWeaponInterface;
    public function getRecoilVertical(): int;
    public function setRecoilVertical(int $recoilVertical): ItemPropertiesWeaponInterface;
    public function getRecoilHorizontal(): int;
    public function setRecoilHorizontal(int $recoilHorizontal): ItemPropertiesWeaponInterface;
    public function getRepairCost(): int;
    public function setRepairCost(int $repairCost): ItemPropertiesWeaponInterface;
    public function getSightingRange(): int;
    public function setSightingRange(int $sightingRange): ItemPropertiesWeaponInterface;
    public function getCenterOfImpact(): float;
    public function setCenterOfImpact(float $centerOfImpact): ItemPropertiesWeaponInterface;
    public function getDeviationCurve(): float;
    public function setDeviationCurve(float $deviationCurve): ItemPropertiesWeaponInterface;
    public function getRecoilDispersion(): int;
    public function setRecoilDispersion(int $recoilDispersion): ItemPropertiesWeaponInterface;
    public function getRecoilAngle(): int;
    public function setRecoilAngle(int $recoilAngle): ItemPropertiesWeaponInterface;
    public function getCameraRecoil(): float;
    public function setCameraRecoil(float $cameraRecoil): ItemPropertiesWeaponInterface;
    public function getCameraSnap(): float;
    public function setCameraSnap(float $cameraSnap): ItemPropertiesWeaponInterface;
    public function getDeviationMax(): float;
    public function setDeviationMax(float $deviationMax): ItemPropertiesWeaponInterface;
    public function getConvergence(): float;
    public function setConvergence(float $convergence): ItemPropertiesWeaponInterface;
    public function getDefaultWidth(): int;
    public function setDefaultWidth(int $defaultWidth): ItemPropertiesWeaponInterface;
    public function getDefaultHeight(): int;
    public function setDefaultHeight(int $defaultHeight): ItemPropertiesWeaponInterface;
    public function getDefaultErgonomics(): float;
    public function setDefaultErgonomics(float $defaultErgonomics): ItemPropertiesWeaponInterface;
    public function getDefaultRecoilVertical(): int;
    public function setDefaultRecoilVertical(int $defaultRecoilVertical): ItemPropertiesWeaponInterface;
    public function getDefaultRecoilHorizontal(): int;
    public function setDefaultRecoilHorizontal(int $defaultRecoilHorizontal): ItemPropertiesWeaponInterface;
    public function getDefaultWeight(): float;
    public function setDefaultWeight(float $defaultWeight): ItemPropertiesWeaponInterface;
    public function getDefaultPreset(): ?ItemInterface;
    public function setDefaultPreset(?ItemInterface $defaultPreset): ItemPropertiesWeaponInterface;
    public function getAllowedPresets(): Collection;
    public function setAllowedPresets(Collection $allowedPresets): ItemPropertiesWeaponInterface;
    public function addAllowedPreset(ItemInterface $preset): ItemPropertiesWeaponInterface;
    public function removeAllowedPreset(ItemInterface $preset): ItemPropertiesWeaponInterface;
    public function getAllowedAmmo(): ?Collection;
    public function setAllowedAmmo(?Collection $allowedAmmo): ItemPropertiesWeaponInterface;
    public function addAllowedAmmo(ItemInterface $ammo): ItemPropertiesWeaponInterface;
    public function removeAllowedAmmo(ItemInterface $ammo): ItemPropertiesWeaponInterface;
}