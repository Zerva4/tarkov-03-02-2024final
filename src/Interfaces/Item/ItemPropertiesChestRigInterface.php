<?php

declare(strict_types=1);

namespace App\Interfaces\Item;

interface ItemPropertiesChestRigInterface
{
    public function getClass(): int;
    public function setClass(int $class): ItemPropertiesChestRigInterface;
    public function getDurability(): int;
    public function setDurability(int $durability): ItemPropertiesChestRigInterface;
    public function getRepairCost(): int;
    public function setRepairCost(int $repairCost): ItemPropertiesChestRigInterface;
    public function getSpeedPenalty(): float;
    public function setSpeedPenalty(float $speedPenalty): ItemPropertiesChestRigInterface;
    public function getTurnPenalty(): float;
    public function setTurnPenalty(float $turnPenalty): ItemPropertiesChestRigInterface;
    public function getErgoPenalty(): int;
    public function setErgoPenalty(int $ergoPenalty): ItemPropertiesChestRigInterface;
    public function getZones(): ?array;
    public function setZones(?array $zones): ItemPropertiesChestRigInterface;
    public function getCapacity(): int;
    public function setCapacity(int $capacity): ItemPropertiesChestRigInterface;
    public function getArmorType(): string;
    public function setArmorType(string $armorType): ItemPropertiesChestRigInterface;
    public function getBluntThroughput(): float;
    public function setBluntThroughput(float $bluntThroughput): ItemPropertiesChestRigInterface;
}