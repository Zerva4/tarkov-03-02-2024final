<?php

namespace App\Interfaces\Item\Properties;

use App\Interfaces\Item\StimulationEffectInterface;
use Doctrine\Common\Collections\Collection;

interface ItemPropertiesStimulationInterface
{
    /**
     * @return int
     */
    public function getUseTime(): int;

    /**
     * @param int $useTime
     * @return ItemPropertiesStimulationInterface
     */
    public function setUseTime(int $useTime): ItemPropertiesStimulationInterface;

    /**
     * @return array|null
     */
    public function getCures(): ?array;

    /**
     * @param array|null $cures
     * @return ItemPropertiesStimulationInterface
     */
    public function setCures(?array $cures): ItemPropertiesStimulationInterface;

    /**
     * @return Collection
     */
    public function getStimulationEffects(): Collection;

    /**
     * @param Collection $stimulationEffects
     * @return ItemPropertiesStimulationInterface
     */
    public function setStimulationEffects(Collection $stimulationEffects): ItemPropertiesStimulationInterface;

    /**
     * @param StimulationEffectInterface $stimulationEffect
     * @return ItemPropertiesStimulationInterface
     */
    public function addStimulationEffect(StimulationEffectInterface $stimulationEffect): ItemPropertiesStimulationInterface;

    /**
     * @param StimulationEffectInterface $stimulationEffect
     * @return ItemPropertiesStimulationInterface
     */
    public function removeStimulationEffect(StimulationEffectInterface $stimulationEffect): ItemPropertiesStimulationInterface;
}