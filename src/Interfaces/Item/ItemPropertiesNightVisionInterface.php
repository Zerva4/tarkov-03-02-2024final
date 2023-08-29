<?php

namespace App\Interfaces\Item;

interface ItemPropertiesNightVisionInterface
{
    public function getIntensity(): int;
    public function setIntensity(int $intensity): ItemPropertiesNightVisionInterface;
    public function getNoiseIntensity(): int;
    public function setNoiseIntensity(int $noiseIntensity): ItemPropertiesNightVisionInterface;
    public function getNoiseScale(): int;
    public function setNoiseScale(int $noiseScale): ItemPropertiesNightVisionInterface;
    public function getDiffuseIntensity(): int;
    public function setDiffuseIntensity(int $diffuseIntensity): ItemPropertiesNightVisionInterface;
}