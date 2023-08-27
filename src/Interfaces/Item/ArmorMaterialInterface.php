<?php

namespace App\Interfaces\Item;

interface ArmorMaterialInterface
{
    public function getApiId(): string;
    public function setApiId(string $apiId): ArmorMaterialInterface;
    public function getDestructibility(): float;
    public function setDestructibility(float $destructibility): ArmorMaterialInterface;
    public function getMinRepairDegradation(): float;
    public function setMinRepairDegradation(float $minRepairDegradation): ArmorMaterialInterface;
    public function getMaxRepairDegradation(): float;
    public function setMaxRepairDegradation(float $maxRepairDegradation): ArmorMaterialInterface;
    public function getExplosionDestructibility(): float;
    public function setExplosionDestructibility(float $explosionDestructibility): ArmorMaterialInterface;
    public function getMinRepairKitDegradation(): float;
    public function setMinRepairKitDegradation(float $minRepairKitDegradation): ArmorMaterialInterface;
    public function getMaxRepairKitDegradation(): float;
    public function setMaxRepairKitDegradation(float $maxRepairKitDegradation): ArmorMaterialInterface;
}