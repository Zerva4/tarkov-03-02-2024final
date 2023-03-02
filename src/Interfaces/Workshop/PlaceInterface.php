<?php

namespace App\Interfaces\Workshop;

use Doctrine\Common\Collections\Collection;

interface PlaceInterface
{
    public function getApiId(): ?string;
    public function setApiId(string $apiId): PlaceInterface;
    public function isPublished(): bool;
    public function setPublished(bool $published): PlaceInterface;
    public function getOrder(): int;
    public function setOrder(int $order): PlaceInterface;
    public function getLevels(): Collection;
    public function setLevels(Collection $levels): PlaceInterface;
}