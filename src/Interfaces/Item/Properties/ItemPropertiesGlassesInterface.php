<?php

declare(strict_types=1);

namespace App\Interfaces\Item\Properties;

interface ItemPropertiesGlassesInterface
{
    public function getClass(): int;
    public function setClass(int $class): ItemPropertiesGlassesInterface;
    public function getDurability(): int;
    public function setDurability(int $durability): ItemPropertiesGlassesInterface;
    public function getRepairCost(): int;
    public function setRepairCost(int $repairCost): ItemPropertiesGlassesInterface;
    public function getBlindnessProtection(): float;
    public function setBlindnessProtection(float $blindnessProtection): ItemPropertiesGlassesInterface;
    public function getBluntThroughput(): float;
    public function setBluntThroughput(float $bluntThroughput): ItemPropertiesGlassesInterface;
}