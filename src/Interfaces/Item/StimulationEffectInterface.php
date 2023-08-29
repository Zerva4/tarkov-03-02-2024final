<?php

namespace App\Interfaces\Item;

interface StimulationEffectInterface
{
    public function getChance(): ?float;
    public function setChance(?float $chance): StimulationEffectInterface;
    public function getDelay(): ?int;
    public function setDelay(?int $delay): StimulationEffectInterface;
    public function getDuration(): ?int;
    public function setDuration(?int $duration): StimulationEffectInterface;
    public function getValue(): ?float;
    public function setValue(?float $value): StimulationEffectInterface;
    public function isPercent(): bool;
    public function setPercent(bool $percent): StimulationEffectInterface;
    public function getProperties(): ItemPropertiesFoodDrinkInterface;
    public function setProperties(ItemPropertiesFoodDrinkInterface $properties): StimulationEffectInterface;
}