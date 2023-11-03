<?php

declare(strict_types=1);

namespace App\Interfaces\Item\Properties;

interface ItemPropertiesPainkillerInterface
{
    public function getUses(): int;
    public function setUses(int $uses): ItemPropertiesPainkillerInterface;
    public function getUseTime(): int;
    public function setUseTime(int $useTime): ItemPropertiesPainkillerInterface;
    public function getCures(): ?array;
    public function setCures(?array $cures): ItemPropertiesPainkillerInterface;
    public function getPainkillerDuration(): int;
    public function setPainkillerDuration(int $painkillerDuration): ItemPropertiesPainkillerInterface;
    public function getEnergyImpact(): int;
    public function setEnergyImpact(int $energyImpact): ItemPropertiesPainkillerInterface;
    public function getHydrationImpact(): int;
    public function setHydrationImpact(int $hydrationImpact): ItemPropertiesPainkillerInterface;
}