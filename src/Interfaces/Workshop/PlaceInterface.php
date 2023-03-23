<?php

namespace App\Interfaces\Workshop;

use Doctrine\Common\Collections\Collection;

interface PlaceInterface
{
    public function getApiId(): ?string;
    public function setApiId(string $apiId): PlaceInterface;
    public function isPublished(): bool;
    public function setPublished(bool $published): PlaceInterface;
    public function getOrderPlace(): ?int;
    public function setOrderPlace(?int $orderPlace): PlaceInterface;
    public function getLevels(): Collection;
    public function setLevels(Collection $levels): PlaceInterface;
    public function addLevel(PlaceLevelInterface $level): PlaceInterface;
    public function removeLevel(PlaceLevelInterface $level): PlaceInterface;
    public function getPlaceRequiredLevels(): Collection;
    public function setPlaceRequiredLevels(Collection $placeRequiredLevels): PlaceInterface;
    public function addPlaceRequiredLevel(PlaceLevelRequiredInterface $placeLevelRequired): PlaceInterface;
    public function removePlaceRequiredLevel(PlaceLevelRequiredInterface $placeLevelRequired): PlaceInterface;
}