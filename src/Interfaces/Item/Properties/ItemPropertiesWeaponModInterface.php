<?php

declare(strict_types=1);

namespace App\Interfaces\Item\Properties;

interface ItemPropertiesWeaponModInterface
{
    /**
     * @return float
     */
    public function getErgonomics(): float;

    /**
     * @param float $ergonomics
     * @return ItemPropertiesWeaponModInterface
     */
    public function setErgonomics(float $ergonomics): ItemPropertiesWeaponModInterface;

    /**
     * @return float
     */
    public function getRecoilModifier(): float;

    /**
     * @param float $recoilModifier
     * @return ItemPropertiesWeaponModInterface
     */
    public function setRecoilModifier(float $recoilModifier): ItemPropertiesWeaponModInterface;

    /**
     * @return float
     */
    public function getAccuracyModifier(): float;

    /**
     * @param float $accuracyModifier
     * @return ItemPropertiesWeaponModInterface
     */
    public function setAccuracyModifier(float $accuracyModifier): ItemPropertiesWeaponModInterface;
}