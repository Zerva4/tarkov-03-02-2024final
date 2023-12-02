<?php

namespace App\Interfaces\Item\Properties;

use App\Interfaces\Item\ItemInterface;

interface ItemPropertiesPresetInterface
{
    public function getBaseItem(): ?ItemInterface;
    public function setBaseItem(?ItemInterface $baseItem): ItemPropertiesPresetInterface;
    public function getErgonomics(): float;
    public function setErgonomics(float $ergonomics): ItemPropertiesPresetInterface;
    public function getRecoilVertical(): int;
    public function setRecoilVertical(int $recoilVertical): ItemPropertiesPresetInterface;
    public function getRecoilHorizontal(): int;
    public function setRecoilHorizontal(int $recoilHorizontal): ItemPropertiesPresetInterface;
    public function getMoa(): float;
    public function setMoa(float $moa): ItemPropertiesPresetInterface;
    public function isDefault(): bool;
    public function setDefault(bool $default): ItemPropertiesPresetInterface;
}