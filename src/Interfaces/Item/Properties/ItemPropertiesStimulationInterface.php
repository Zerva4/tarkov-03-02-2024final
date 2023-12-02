<?php

namespace App\Interfaces\Item\Properties;

use App\Interfaces\Item\StimulationEffectInterface;

interface ItemPropertiesStimulationInterface
{
    public function getUseTime(): int;
    public function setUseTime(int $useTime): ItemPropertiesStimulationInterface;
    public function getCures(): ?array;
    public function setCures(?array $cures): ItemPropertiesStimulationInterface;
    public function getStimulationEffect(): ?StimulationEffectInterface;
    public function setStimulationEffect(?StimulationEffectInterface $stimulationEffect): ItemPropertiesStimulationInterface;
}