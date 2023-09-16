<?php

declare(strict_types=1);

namespace App\Interfaces\Item;

use Doctrine\Common\Collections\Collection;

interface ItemPropertiesFoodDrinkInterface
{
    public function getEnergy(): int;
    public function setEnergy(int $energy): ItemPropertiesFoodDrinkInterface;
    public function getHydration(): int;
    public function setHydration(int $hydration): ItemPropertiesFoodDrinkInterface;
    public function getUnits(): int;
    public function setUnits(int $units): ItemPropertiesFoodDrinkInterface;
    public function getStimulationEffects(): Collection;
    public function setStimulationEffects(Collection $stimulationEffects): ItemPropertiesFoodDrinkInterface;
    public function addStimulationEffect(StimulationEffectInterface $stimulationEffect): ItemPropertiesFoodDrinkInterface;
    public function removeStimulationEffect(StimulationEffectInterface $stimulationEffect): ItemPropertiesFoodDrinkInterface;
}