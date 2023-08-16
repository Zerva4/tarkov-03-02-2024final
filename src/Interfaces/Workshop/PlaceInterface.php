<?php

namespace App\Interfaces\Workshop;

use Doctrine\Common\Collections\Collection;

interface PlaceInterface
{
    /**
     * @return string|null
     */
    public function getApiId(): ?string;

    /**
     * @param string $apiId
     * @return PlaceInterface
     */
    public function setApiId(string $apiId): PlaceInterface;

    /**
     * @return bool
     */
    public function isPublished(): bool;

    /**
     * @param bool $published
     * @return PlaceInterface
     */
    public function setPublished(bool $published): PlaceInterface;

    /**
     * @return int|null
     */
    public function getOrderPlace(): ?int;

    /**
     * @param int|null $orderPlace
     * @return PlaceInterface
     */
    public function setOrderPlace(?int $orderPlace): PlaceInterface;

    /**
     * @return Collection
     */
    public function getLevels(): Collection;

    /**
     * @param Collection $levels
     * @return PlaceInterface
     */
    public function setLevels(Collection $levels): PlaceInterface;

    /**
     * @param PlaceLevelInterface $level
     * @return PlaceInterface
     */
    public function addLevel(PlaceLevelInterface $level): PlaceInterface;

    /**
     * @param PlaceLevelInterface $level
     * @return PlaceInterface
     */
    public function removeLevel(PlaceLevelInterface $level): PlaceInterface;

    /**
     * @return Collection
     */
    public function getPlaceRequiredLevels(): Collection;

    /**
     * @param Collection $placeRequiredLevels
     * @return PlaceInterface
     */
    public function setPlaceRequiredLevels(Collection $placeRequiredLevels): PlaceInterface;

    /**
     * @param PlaceLevelRequiredInterface $placeLevelRequired
     * @return PlaceInterface
     */
    public function addPlaceRequiredLevel(PlaceLevelRequiredInterface $placeLevelRequired): PlaceInterface;

    /**
     * @param PlaceLevelRequiredInterface $placeLevelRequired
     * @return PlaceInterface
     */
    public function removePlaceRequiredLevel(PlaceLevelRequiredInterface $placeLevelRequired): PlaceInterface;

    /**
     * @return Collection
     */
    public function getCrafts(): Collection;

    /**
     * @param Collection $crafts
     * @return PlaceInterface
     */
    public function setCrafts(Collection $crafts): PlaceInterface;

    /**
     * @param CraftInterface $craft
     * @return PlaceInterface
     */
    public function addCraft(CraftInterface $craft): PlaceInterface;

    /**
     * @param CraftInterface $craft
     * @return PlaceInterface
     */
    public function removeCraft(CraftInterface $craft): PlaceInterface;
}