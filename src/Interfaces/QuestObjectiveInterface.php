<?php

namespace App\Interfaces;

use Ramsey\Uuid\UuidInterface;

interface QuestObjectiveInterface
{
    public function getId(): UuidInterface;
    public function setId(UuidInterface $id): void;
    public function getType(): ?string;
    public function isOptional(): bool;
}