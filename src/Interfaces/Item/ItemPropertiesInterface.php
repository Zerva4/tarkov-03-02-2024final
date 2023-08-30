<?php

namespace App\Interfaces\Item;

use Doctrine\Common\Collections\Collection;

interface ItemPropertiesInterface
{
    public function getItem(): ItemInterface;
    public function setItem(ItemInterface $item): ItemPropertiesInterface;
    public function getMaterial(): ?ArmorMaterialInterface;
    public function setMaterial(?ArmorMaterialInterface $material): ItemPropertiesInterface;
    public function getGrids(): ?ItemStorageGridInterface;
    public function setGrids(?ItemStorageGridInterface $grids): ItemPropertiesInterface;
}