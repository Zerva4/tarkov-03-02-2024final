<?php

declare(strict_types=1);

namespace App\Interfaces\Item\Properties;

interface ItemPropertiesArmorInterface
{
    public function getClass(): int;
    public function setClass(int $class): ItemPropertiesArmorInterface;
    public function getDurability(): int;
    public function setDurability(int $durability): ItemPropertiesArmorInterface;
    public function getRepairCost(): int;
    public function setRepairCost(int $repairCost): ItemPropertiesArmorInterface;
    public function getSpeedPenalty(): float;
    public function setSpeedPenalty(float $speedPenalty): ItemPropertiesArmorInterface;
    public function getTurnPenalty(): float;
    public function setTurnPenalty(float $turnPenalty): ItemPropertiesArmorInterface;
    public function getErgoPenalty(): int;
    public function setErgoPenalty(int $ergoPenalty): ItemPropertiesArmorInterface;
    public function getZones(): ?array;
    public function setZones(?array $zones): ItemPropertiesArmorInterface;
    public function getArmorType(): string;
    public function setArmorType(string $armorType): ItemPropertiesArmorInterface;
    public function getBluntThroughput(): float;
    public function setBluntThroughput(float $bluntThroughput): ItemPropertiesArmorInterface;
}