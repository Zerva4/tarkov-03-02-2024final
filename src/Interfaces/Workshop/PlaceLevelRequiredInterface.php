<?php

declare(strict_types=1);

namespace App\Interfaces\Workshop;

use Doctrine\Common\Collections\Collection;

interface PlaceLevelRequiredInterface
{
    public function getApiId(): ?string;
    public function setApiId(?string $apiId): PlaceLevelRequiredInterface;
    public function getPlace(): ?PlaceInterface;
    public function setPlace(?PlaceInterface $place): PlaceLevelRequiredInterface;
    public function getLevel(): int;
    public function setLevel(int $level): PlaceLevelRequiredInterface;
    public function getRequiredForPlacesLevels(): Collection;
    public function setRequiredForPlacesLevels(Collection $requiredForPlacesLevels): PlaceLevelRequiredInterface;
    public function addRequiredForPlacesLevel(PlaceLevelInterface $placeLevel): PlaceLevelRequiredInterface;
    public function removeRequiredForPlacesLevel(PlaceLevelInterface $placeLevel): PlaceLevelRequiredInterface;
}