<?php

declare(strict_types=1);

namespace App\Interfaces\Item\Properties;

use App\Interfaces\Item\ItemCaliberInterface;
use App\Interfaces\Item\ItemInterface;
use App\Interfaces\Item\ItemMaterialInterface;
use App\Interfaces\Item\ItemStorageGridInterface;

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