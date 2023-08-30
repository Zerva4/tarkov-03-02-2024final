<?php

declare(strict_types=1);

namespace App\Interfaces\Item;

interface ItemPropertiesHelmetInterface
{
    public function getClass(): int;
    public function setClass(int $class): ItemPropertiesHelmetInterface;
    public function getDurability(): int;
    public function setDurability(int $durability): ItemPropertiesHelmetInterface;
    public function getRepairCost(): int;
    public function setRepairCost(int $repairCost): ItemPropertiesHelmetInterface;
    public function getSpeedPenalty(): int;
    public function setSpeedPenalty(int $speedPenalty): ItemPropertiesHelmetInterface;
    public function getTurnPenalty(): int;
    public function setTurnPenalty(int $turnPenalty): ItemPropertiesHelmetInterface;
    public function getErgoPenalty(): int;
    public function setErgoPenalty(int $ergoPenalty): ItemPropertiesHelmetInterface;
    public function getHeadZones(): ?array;
    public function setHeadZones(?array $headZones): ItemPropertiesHelmetInterface;
    public function getDeafening(): string;
    public function setDeafening(string $deafening): ItemPropertiesHelmetInterface;
    public function isBlockHeadset(): bool;
    public function setBlockHeadset(bool $blockHeadset): ItemPropertiesHelmetInterface;
    public function getBlindnessProtection(): float;
    public function setBlindnessProtection(float $blindnessProtection): ItemPropertiesHelmetInterface;
    public function getRicochetX(): float;
    public function setRicochetX(float $ricochetX): ItemPropertiesHelmetInterface;
    public function getRicochetY(): float;
    public function setRicochetY(float $ricochetY): ItemPropertiesHelmetInterface;
    public function getRicochetZ(): float;
    public function setRicochetZ(float $ricochetZ): ItemPropertiesHelmetInterface;
    public function getArmorType(): string;
    public function setArmorType(string $armorType): ItemPropertiesHelmetInterface;
    public function getBluntThroughput(): float;
    public function setBluntThroughput(float $bluntThroughput): ItemPropertiesHelmetInterface;
}