<?php

namespace App\Interfaces\Item;

interface ItemPropertiesGrenadeInterface
{
    public function getType(): string;
    public function setType(string $type): ItemPropertiesGrenadeInterface;
    public function getFuse(): float;
    public function setFuse(float $fuse): ItemPropertiesGrenadeInterface;
    public function getMinExplosionDistance(): float;
    public function setMinExplosionDistance(float $minExplosionDistance): ItemPropertiesGrenadeInterface;
    public function getMaxExplosionDistance(): float;
    public function setMaxExplosionDistance(float $maxExplosionDistance): ItemPropertiesGrenadeInterface;
    public function getFragments(): float;
    public function setFragments(float $fragments): ItemPropertiesGrenadeInterface;
    public function getContusionRadius(): float;
    public function setContusionRadius(float $contusionRadius): ItemPropertiesGrenadeInterface;
}