<?php

declare(strict_types=1);

namespace App\Interfaces;

use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\UuidInterface;

interface BossInterface
{
    /**
     * @return UuidInterface|null
     */
    public function getId(): ?UuidInterface;

    /**
     * @param UuidInterface $id
     * @return void
     */
    public function setId(UuidInterface $id): void;

    /**
     * @return bool
     */
    public function isPublished(): bool;

    /**
     * @return bool
     */
    public function getPublished(): bool;

    /**
     * @param bool $published
     * @return BossInterface
     */
    public function setPublished(bool $published): BossInterface;

    public function getSlug(): string;

    public function setSlug(string $slug): BossInterface;

    public function getName(): string;

    public function setName(string $name): BossInterface;

    /**
     * @return Collection
     */
    public function getEquipment(): Collection;

    /**
     * @param Collection $equipment
     * @return BossInterface
     */
    public function setEquipment(Collection $equipment): BossInterface;

    /**
     * @return Collection
     */
    public function getHealth(): Collection;

    /**
     * @param Collection $health
     * @return BossInterface
     */
    public function setHealth(Collection $health): BossInterface;

    /**
     * @param BossHealthInterface $health
     * @return BossInterface
     */
    public function addHealth(BossHealthInterface $health): BossInterface;

    /**
     * @param BossHealthInterface $health
     * @return BossInterface
     */
    public function removeHealth(BossHealthInterface $health): BossInterface;
}