<?php

declare(strict_types=1);

namespace App\Interfaces\Item\Properties;

interface ItemPropertiesGrenadeInterface
{
    public function getType(): string;
    public function setType(string $type): ItemPropertiesGrenadeInterface;
    public function getFuse(): float;
    public function setFuse(float $fuse): ItemPropertiesGrenadeInterface;
    public function getMinExplosionDistance(): int;
    public function setMinExplosionDistance(int $minExplosionDistance): ItemPropertiesGrenadeInterface;
    public function getMaxExplosionDistance(): int;
    public function setMaxExplosionDistance(int $maxExplosionDistance): ItemPropertiesGrenadeInterface;
    public function getFragments(): int;
    public function setFragments(int $fragments): ItemPropertiesGrenadeInterface;
    public function getContusionRadius(): int;
    public function setContusionRadius(int $contusionRadius): ItemPropertiesGrenadeInterface;
}