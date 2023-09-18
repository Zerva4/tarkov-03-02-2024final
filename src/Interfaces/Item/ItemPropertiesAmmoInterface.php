<?php

declare(strict_types=1);

namespace App\Interfaces\Item;

interface ItemPropertiesAmmoInterface
{
    public function getCaliber(): string;
    public function setCaliber(string $caliber): ItemPropertiesAmmoInterface;
    public function getStackMaxSize(): int;
    public function setStackMaxSize(int $stackMaxSize): ItemPropertiesAmmoInterface;
    public function isTracer(): bool;
    public function setTracer(bool $tracer): ItemPropertiesAmmoInterface;
    public function getTracerColor(): string;
    public function setTracerColor(string $tracerColor): ItemPropertiesAmmoInterface;
    public function getAmmoType(): string;
    public function setAmmoType(string $ammoType): ItemPropertiesAmmoInterface;
    public function getProjectileCount(): int;
    public function setProjectileCount(int $projectileCount): ItemPropertiesAmmoInterface;
    public function getDamage(): int;
    public function setDamage(int $damage): ItemPropertiesAmmoInterface;
    public function getArmorDamage(): int;
    public function setArmorDamage(int $armorDamage): ItemPropertiesAmmoInterface;
    public function getFragmentationChance(): float;
    public function setFragmentationChance(float $fragmentationChance): ItemPropertiesAmmoInterface;
    public function getRicochetChance(): float;
    public function setRicochetChance(float $ricochetChance): ItemPropertiesAmmoInterface;
    public function getPenetrationChance(): float;
    public function setPenetrationChance(float $penetrationChance): ItemPropertiesAmmoInterface;
    public function getPenetrationPower(): int;
    public function setPenetrationPower(int $penetrationPower): ItemPropertiesAmmoInterface;
    public function getAccuracyModifier(): float;
    public function setAccuracyModifier(float $accuracyModifier): ItemPropertiesAmmoInterface;
    public function getRecoilModifier(): float;
    public function setRecoilModifier(float $recoilModifier): ItemPropertiesAmmoInterface;
    public function getInitialSpeed(): float;
    public function setInitialSpeed(float $initialSpeed): ItemPropertiesAmmoInterface;
    public function getLightBleedModifier(): float;
    public function setLightBleedModifier(float $lightBleedModifier): ItemPropertiesAmmoInterface;
    public function getHeavyBleedModifier(): float;
    public function setHeavyBleedModifier(float $heavyBleedModifier): ItemPropertiesAmmoInterface;
    public function getDurabilityBurnFactor(): float;
    public function setDurabilityBurnFactor(float $durabilityBurnFactor): ItemPropertiesAmmoInterface;
    public function getHeatFactor(): float;
    public function setHeatFactor(float $heatFactor): ItemPropertiesAmmoInterface;
    public function getStaminaBurnPerDamage(): float;
    public function setStaminaBurnPerDamage(float $staminaBurnPerDamage): ItemPropertiesAmmoInterface;
    public function getBallisticCoefficient(): float;
    public function setBallisticCoefficient(float $ballisticCoefficient): ItemPropertiesAmmoInterface;
    public function getBulletDiameterMillimeters(): float;
    public function setBulletDiameterMillimeters(float $bulletDiameterMillimeters): ItemPropertiesAmmoInterface;
    public function getBulletMassGrams(): float;
    public function setBulletMassGrams(float $bulletMassGrams): ItemPropertiesAmmoInterface;
}