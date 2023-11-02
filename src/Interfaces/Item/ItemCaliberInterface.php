<?php

declare(strict_types=1);

namespace App\Interfaces\Item;

use App\Interfaces\Item\Properties\ItemPropertiesInterface;
use Doctrine\Common\Collections\Collection;

interface ItemCaliberInterface
{
    public function isPublished(): bool;
    public function setPublished(bool $published): ItemCaliberInterface;
    public function getApiId(): string;
    public function setApiId(string $apiId): ItemCaliberInterface;
    public function getSlug(): string;
    public function setSlug(string $slug): ItemCaliberInterface;
    public function isAmmo(): bool;
    public function setIsAmmo(bool $isAmmo): ItemCaliberInterface;
    public function getName(): string;
    public function setName(string $name): ItemCaliberInterface;
    public function getProperties(): Collection;
    public function setProperties(Collection $properties): ItemCaliberInterface;
    public function addProperties(ItemPropertiesInterface $properties): ItemCaliberInterface;
    public function removeProperties(ItemPropertiesInterface $properties): ItemCaliberInterface;
}