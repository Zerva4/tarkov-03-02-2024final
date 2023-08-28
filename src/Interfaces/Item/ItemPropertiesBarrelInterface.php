<?php

declare(strict_types=1);

namespace App\Interfaces\Item;

interface ItemPropertiesBarrelInterface
{
    public function getErgonomics(): int;
    public function setErgonomics(int $ergonomics): ItemPropertiesBarrelInterface;
    public function getRecoilModifier(): int;
    public function setRecoilModifier(int $recoilModifier): ItemPropertiesBarrelInterface;
    public function getCenterOfImpact(): int;
    public function setCenterOfImpact(int $centerOfImpact): ItemPropertiesBarrelInterface;
    public function getDeviationCurve(): int;
    public function setDeviationCurve(int $deviationCurve): ItemPropertiesBarrelInterface;
    public function getDeviationMax(): int;
    public function setDeviationMax(int $deviationMax): ItemPropertiesBarrelInterface;
}