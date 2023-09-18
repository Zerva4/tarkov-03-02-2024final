<?php

declare(strict_types=1);

namespace App\Interfaces\Trader;

use App\Interfaces\Workshop\PlaceLevelInterface;
use Doctrine\Common\Collections\Collection;

interface TraderRequiredInterface
{
    public function getApiId(): ?string;
    public function setApiId(?string $apiId): TraderRequiredInterface;
    public function getTrader(): ?TraderInterface;
    public function setTrader(?TraderInterface $trader): TraderRequiredInterface;
    public function getLevel(): int;
    public function setLevel(int $level): TraderRequiredInterface;
    public function getRequiredForPlacesLevels(): Collection;
    public function setRequiredForPlacesLevels(Collection $requiredForPlacesLevels): TraderRequiredInterface;
    public function addRequiredForPlacesLevel(PlaceLevelInterface $placeLevel): TraderRequiredInterface;
    public function removeRequiredForPlacesLevel(PlaceLevelInterface $placeLevel): TraderRequiredInterface;
}