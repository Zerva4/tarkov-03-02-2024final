<?php

namespace App\Interfaces\Item;

interface ItemPropertiesScopeInterface
{
    public function getErgonomics(): int;
    public function setErgonomics(int $ergonomics): ItemPropertiesScopeInterface;
    public function getSightModes(): ?array;
    public function setSightModes(?array $sightModes): ItemPropertiesScopeInterface;
    public function getSightingRange(): int;
    public function setSightingRange(int $sightingRange): ItemPropertiesScopeInterface;
    public function getRecoilModifier(): int;
    public function setRecoilModifier(int $recoilModifier): ItemPropertiesScopeInterface;
    public function getZoomLevels(): ?array;
    public function setZoomLevels(?array $zoomLevels): ItemPropertiesScopeInterface;
}