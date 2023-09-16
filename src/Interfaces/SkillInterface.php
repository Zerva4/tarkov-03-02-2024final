<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Interfaces\Workshop\PlaceLevelInterface;
use Doctrine\Common\Collections\Collection;

interface SkillInterface
{
    public function getApiId(): ?string;
    public function setApiId(?string $apiId): SkillInterface;
    public function getName(): ?string;
    public function setName(string $name): SkillInterface;
    public function getLevel(): int;
    public function setLevel(int $level): SkillInterface;
    public function getRequiredForPlacesLevels(): Collection;
    public function setRequiredForPlacesLevels(Collection $requiredForPlacesLevels): SkillInterface;
    public function addRequiredForPlacesLevel(PlaceLevelInterface $placeLevel): SkillInterface;
    public function removeRequiredForPlacesLevel(PlaceLevelInterface $placeLevel): SkillInterface;
}