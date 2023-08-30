<?php

namespace App\Interfaces\Item;

interface ItemPropertiesContainerInterface
{
    public function getCapacity(): int;
    public function setCapacity(int $capacity): ItemPropertiesContainerInterface;
}