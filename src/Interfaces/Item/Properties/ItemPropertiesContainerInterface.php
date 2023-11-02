<?php

declare(strict_types=1);

namespace App\Interfaces\Item\Properties;

interface ItemPropertiesContainerInterface
{
    public function getCapacity(): int;
    public function setCapacity(int $capacity): ItemPropertiesContainerInterface;
}