<?php

declare(strict_types=1);

namespace App\Interfaces\Item;

interface ItemPropertiesBackpackInterface
{
    public function getCapacity(): int;
    public function setCapacity(int $capacity): ItemPropertiesBackpackInterface;
    public function getSpeedPenalty(): int;
    public function setSpeedPenalty(int $speedPenalty): ItemPropertiesBackpackInterface;
    public function getTurnPenalty(): int;
    public function setTurnPenalty(int $turnPenalty): ItemPropertiesBackpackInterface;
    public function getErgoPenalty(): int;
    public function setErgoPenalty(int $ergoPenalty): ItemPropertiesBackpackInterface;
}