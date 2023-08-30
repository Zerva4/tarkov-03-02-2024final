<?php

namespace App\Interfaces\Item;

interface ItemPropertiesMeleeInterface
{
    public function getSlashDamage(): int;
    public function setSlashDamage(int $slashDamage): ItemPropertiesMeleeInterface;
    public function getStabDamage(): int;
    public function setStabDamage(int $stabDamage): ItemPropertiesMeleeInterface;
    public function getHitRadius(): int;
    public function setHitRadius(int $hitRadius): ItemPropertiesMeleeInterface;
}