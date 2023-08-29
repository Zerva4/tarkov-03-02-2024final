<?php

declare(strict_types=1);

namespace App\Interfaces\Item;

interface ItemPropertiesFoodDrinkInterface
{
    public function getEnergy(): int;
    public function setEnergy(int $energy): ItemPropertiesFoodDrinkInterface;
    public function getHydration(): int;
    public function setHydration(int $hydration): ItemPropertiesFoodDrinkInterface;
    public function getUnits(): int;
    public function setUnits(int $units): ItemPropertiesFoodDrinkInterface;
}