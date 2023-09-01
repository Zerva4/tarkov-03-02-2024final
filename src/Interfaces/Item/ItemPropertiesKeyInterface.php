<?php

declare(strict_types=1);

namespace App\Interfaces\Item;

interface ItemPropertiesKeyInterface
{
    public function getUses(): int;
    public function setUses(int $uses): ItemPropertiesKeyInterface;
}