<?php

declare(strict_types=1);

namespace App\Interfaces\Item\Properties;

interface ItemPropertiesBackpackInterface
{
    public function getCapacity(): int;
    public function setCapacity(int $capacity): ItemPropertiesBackpackInterface;
    public function getSpeedPenalty(): float;
    public function setSpeedPenalty(float $speedPenalty): ItemPropertiesBackpackInterface;
    public function getTurnPenalty(): float;
    public function setTurnPenalty(float $turnPenalty): ItemPropertiesBackpackInterface;
    public function getErgoPenalty(): int;
    public function setErgoPenalty(int $ergoPenalty): ItemPropertiesBackpackInterface;
}