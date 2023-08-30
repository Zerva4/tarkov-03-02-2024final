<?php

declare(strict_types=1);

namespace App\Interfaces\Item;

interface ItemPropertiesSurgicalKitInterface
{
    public function getUses(): int;
    public function setUses(int $uses): ItemPropertiesSurgicalKitInterface;
    public function getUseTime(): int;
    public function setUseTime(int $useTime): ItemPropertiesSurgicalKitInterface;
    public function getCures(): ?array;
    public function setCures(?array $cures): ItemPropertiesSurgicalKitInterface;
    public function getMinLimbHealth(): int;
    public function setMinLimbHealth(int $minLimbHealth): ItemPropertiesSurgicalKitInterface;
    public function getMaxLimbHealth(): int;
    public function setMaxLimbHealth(int $maxLimbHealth): ItemPropertiesSurgicalKitInterface;
}