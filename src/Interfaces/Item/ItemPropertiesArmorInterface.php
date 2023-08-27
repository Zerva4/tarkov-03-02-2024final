<?php

namespace App\Interfaces\Item;

interface ItemPropertiesArmorInterface
{
    public function getClass(): int;
    public function setClass(int $class): ItemPropertiesArmorInterface;
    public function getDurability(): int;
    public function setDurability(int $durability): ItemPropertiesArmorInterface;
    public function getRepairCost(): int;
    public function setRepairCost(int $repairCost): ItemPropertiesArmorInterface;
    public function getSpeedPenalty(): int;
    public function setSpeedPenalty(int $speedPenalty): ItemPropertiesArmorInterface;
    public function getTurnPenalty(): int;
    public function setTurnPenalty(int $turnPenalty): ItemPropertiesArmorInterface;
    public function getErgoPenalty(): int;
    public function setErgoPenalty(int $ergoPenalty): ItemPropertiesArmorInterface;
    public function getZones(): ?array;
    public function setZones(?array $zones): ItemPropertiesArmorInterface;
    public function getArmorType(): string;
    public function setArmorType(string $armorType): ItemPropertiesArmorInterface;
}