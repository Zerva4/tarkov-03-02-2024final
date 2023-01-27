<?php

namespace App\Interfaces;

use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\UuidInterface;

interface QuestObjectiveInterface
{
    public function getApiId(): ?string;

    public function setApiId(string $apiId): QuestObjectiveInterface;

    public function getType(): ?string;
    public function setType(?string $type): QuestObjectiveInterface;
    public function isOptional(): bool;
    public function setOptional(bool $optional): QuestObjectiveInterface;
    public function getQuest(): QuestInterface;
    public function setQuest(?QuestInterface $quest): QuestObjectiveInterface;
    public function getMaps(): Collection;
    public function addMap(MapInterface ...$maps): QuestObjectiveInterface;
    public function removeMap(MapInterface $map): QuestObjectiveInterface;
    public function setMaps(Collection $maps): QuestObjectiveInterface;
}