<?php

declare(strict_types=1);

namespace App\Interfaces\Item\Properties;

interface ItemPropertiesSurgicalKitInterface
{
    public function getUses(): int;
    public function setUses(int $uses): ItemPropertiesSurgicalKitInterface;
    public function getUseTime(): int;
    public function setUseTime(int $useTime): ItemPropertiesSurgicalKitInterface;
    public function getCures(): ?array;
    public function setCures(?array $cures): ItemPropertiesSurgicalKitInterface;
    public function getMinLimbHealth(): float;
    public function setMinLimbHealth(float $minLimbHealth): ItemPropertiesSurgicalKitInterface;
    public function getMaxLimbHealth(): float;
    public function setMaxLimbHealth(float $maxLimbHealth): ItemPropertiesSurgicalKitInterface;
}