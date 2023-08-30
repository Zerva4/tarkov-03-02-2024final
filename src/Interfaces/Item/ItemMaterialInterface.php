<?php

namespace App\Interfaces\Item;

use Doctrine\Common\Collections\Collection;

interface ItemMaterialInterface
{
    public function getApiId(): string;
    public function setApiId(string $apiId): ItemMaterialInterface;
    public function isPublished(): bool;
    public function setPublished(bool $published): ItemMaterialInterface;
    public function getName(): ?string;
    public function setName(string $name): ItemMaterialInterface;
    public function getDestructibility(): float;
    public function setDestructibility(float $destructibility): ItemMaterialInterface;
    public function getMinRepairDegradation(): float;
    public function setMinRepairDegradation(float $minRepairDegradation): ItemMaterialInterface;
    public function getMaxRepairDegradation(): float;
    public function setMaxRepairDegradation(float $maxRepairDegradation): ItemMaterialInterface;
    public function getExplosionDestructibility(): float;
    public function setExplosionDestructibility(float $explosionDestructibility): ItemMaterialInterface;
    public function getMinRepairKitDegradation(): float;
    public function setMinRepairKitDegradation(float $minRepairKitDegradation): ItemMaterialInterface;
    public function getMaxRepairKitDegradation(): float;
    public function setMaxRepairKitDegradation(float $maxRepairKitDegradation): ItemMaterialInterface;
    public function getProperties(): Collection;
    public function setProperties(Collection $properties): ItemMaterialInterface;
    public function addProperties(ItemPropertiesInterface $properties): ItemMaterialInterface;
    public function removeProperties(ItemPropertiesInterface $properties): ItemMaterialInterface;
}