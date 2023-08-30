<?php

namespace App\Interfaces\Item;

interface ItemPropertiesMedicalItemInterface
{
    public function getCures(): ?array;
    public function setCures(?array $cures): ItemPropertiesMedicalItemInterface;
    public function getUses(): int;
    public function setUses(int $uses): ItemPropertiesMedicalItemInterface;
    public function getUseTime(): int;
    public function setUseTime(int $useTime): ItemPropertiesMedicalItemInterface;
}