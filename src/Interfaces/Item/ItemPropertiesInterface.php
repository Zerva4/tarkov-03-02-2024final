<?php

namespace App\Interfaces\Item;

interface ItemPropertiesInterface
{
    public function getItem(): ItemInterface;
    public function setItem(ItemInterface $item): ItemPropertiesInterface;
}