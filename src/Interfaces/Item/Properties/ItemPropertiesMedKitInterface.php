<?php

declare(strict_types=1);

namespace App\Interfaces\Item\Properties;

interface ItemPropertiesMedKitInterface
{
    public function getHitPoints(): int;
    public function setHitPoints(int $hitPoints): ItemPropertiesMedKitInterface;
    public function getUseTime(): int;
    public function setUseTime(int $useTime): ItemPropertiesMedKitInterface;
    public function getMaxHealPerUse(): int;
    public function setMaxHealPerUse(int $maxHealPerUse): ItemPropertiesMedKitInterface;
    public function getCures(): ?array;
    public function setCures(?array $cures): ItemPropertiesMedKitInterface;
    public function getHpCostLightBleeding(): int;
    public function setHpCostLightBleeding(int $hpCostLightBleeding): ItemPropertiesMedKitInterface;
    public function getHpCostHeavyBleeding(): int;
    public function setHpCostHeavyBleeding(int $hpCostHeavyBleeding): ItemPropertiesMedKitInterface;
}