<?php

namespace App\Interfaces;

/**
 * Interface for Item material entity.
 */
interface ItemMaterialInterface
{
    /**
     * @return string|null
     */
    public function getApiId(): ?string;

    /**
     * @param string|null $apiId
     * @return ItemMaterialInterface
     */
    public function setApiId(?string $apiId): ItemMaterialInterface;

    /**
     * @return float|null
     */
    public function getDestructibility(): ?float;

    /**
     * @param float $destructibility
     * @return ItemMaterialInterface
     */
    public function setDestructibility(float $destructibility): ItemMaterialInterface;

    /**
     * @return float|null
     */
    public function getMinRepairDegradation(): ?float;

    /**
     * @param float $minRepairDegradation
     * @return ItemMaterialInterface
     */
    public function setMinRepairDegradation(float $minRepairDegradation): ItemMaterialInterface;

    /**
     * @return float|null
     */
    public function getMaxRepairDegradation(): ?float;

    /**
     * @param float $maxRepairDegradation
     * @return ItemMaterialInterface
     */
    public function setMaxRepairDegradation(float $maxRepairDegradation): ItemMaterialInterface;

    /**
     * @return float|null
     */
    public function getExplosionDestructibility(): ?float;

    /**
     * @param float $explosionDestructibility
     * @return ItemMaterialInterface
     */
    public function setExplosionDestructibility(float $explosionDestructibility): ItemMaterialInterface;

    /**
     * @return float|null
     */
    public function getMinRepairKitDegradation(): ?float;

    /**
     * @param float $minRepairKitDegradation
     * @return ItemMaterialInterface
     */
    public function setMinRepairKitDegradation(float $minRepairKitDegradation): ItemMaterialInterface;

    /**
     * @return float|null
     */
    public function getMaxRepairKitDegradation(): ?float;

    /**
     * @param float $maxRepairKitDegradation
     * @return ItemMaterialInterface
     */
    public function setMaxRepairKitDegradation(float $maxRepairKitDegradation): ItemMaterialInterface;
}