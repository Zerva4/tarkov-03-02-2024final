<?php

declare(strict_types=1);

namespace App\Interfaces\Item;

interface ItemPropertiesInterface
{
    public function getItem(): ItemInterface;
    public function setItem(ItemInterface $item): ItemPropertiesInterface;
    public function getMaterial(): ?ItemMaterialInterface;
    public function setMaterial(?ItemMaterialInterface $material): ItemPropertiesInterface;
    public function getGrids(): ?ItemStorageGridInterface;
    public function setGrids(?ItemStorageGridInterface $grids): ItemPropertiesInterface;
    public function getCaliber(): ?ItemCaliberInterface;
    public function setCaliber(?ItemCaliberInterface $caliber): ItemPropertiesInterface;
}