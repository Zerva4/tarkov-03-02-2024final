<?php

declare(strict_types=1);

namespace App\Interfaces\Item;

interface ItemPropertiesBarrelInterface
{
    public function getErgonomics(): float;
    public function setErgonomics(float $ergonomics): ItemPropertiesBarrelInterface;
    public function getRecoilModifier(): float;
    public function setRecoilModifier(float $recoilModifier): ItemPropertiesBarrelInterface;
    public function getCenterOfImpact(): float;
    public function setCenterOfImpact(float $centerOfImpact): ItemPropertiesBarrelInterface;
    public function getDeviationCurve(): float;
    public function setDeviationCurve(float $deviationCurve): ItemPropertiesBarrelInterface;
    public function getDeviationMax(): float;
    public function setDeviationMax(float $deviationMax): ItemPropertiesBarrelInterface;
}