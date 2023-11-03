<?php

declare(strict_types=1);

namespace App\Interfaces\Item\Properties;

interface ItemPropertiesMedicalItemInterface
{
    public function getCures(): ?array;
    public function setCures(?array $cures): ItemPropertiesMedicalItemInterface;
    public function getUses(): int;
    public function setUses(int $uses): ItemPropertiesMedicalItemInterface;
    public function getUseTime(): int;
    public function setUseTime(int $useTime): ItemPropertiesMedicalItemInterface;
}