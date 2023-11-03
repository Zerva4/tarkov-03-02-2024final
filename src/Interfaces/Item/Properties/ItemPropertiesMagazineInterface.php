<?php

declare(strict_types=1);

namespace App\Interfaces\Item\Properties;

use App\Interfaces\Item\ItemInterface;
use Doctrine\Common\Collections\Collection;

interface ItemPropertiesMagazineInterface
{
    public function getErgonomics(): float;
    public function setErgonomics(float $ergonomics): ItemPropertiesMagazineInterface;
    public function getRecoilModifier(): float;
    public function setRecoilModifier(float $recoilModifier): ItemPropertiesMagazineInterface;
    public function getCapacity(): int;
    public function setCapacity(int $capacity): ItemPropertiesMagazineInterface;
    public function getLoadModifier(): float;
    public function setLoadModifier(float $loadModifier): ItemPropertiesMagazineInterface;
    public function getAmmoCheckModifier(): float;
    public function setAmmoCheckModifier(float $ammoCheckModifier): ItemPropertiesMagazineInterface;
    public function getMalfunctionChance(): float;
    public function setMalfunctionChance(float $malfunctionChance): ItemPropertiesMagazineInterface;
    public function getAllowedAmmo(): ?Collection;
    public function setAllowedAmmo(?Collection $allowedAmmo): ItemPropertiesMagazineInterface;
    public function addAllowedAmmo(ItemInterface $ammo): ItemPropertiesMagazineInterface;
    public function removeAllowedAmmo(ItemInterface $ammo): ItemPropertiesMagazineInterface;
}