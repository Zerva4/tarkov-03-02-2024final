<?php

namespace App\Interfaces;

use Doctrine\Common\Collections\Collection;

interface GameItemInterface
{
    /**
     * @return string
     */
    public function getApiId(): string;

    /**
     * @param string $apiId
     * @return GameItemInterface
     */
    public function setApiId(string $apiId): GameItemInterface;

    /**
     * @return bool
     */
    public function isPublished(): bool;

    /**
     * @param bool $published
     * @return GameItemInterface
     */
    public function setPublished(bool $published): GameItemInterface;

    /**
     * @return string
     */
    public function getSlug(): string;

    /**
     * @param string $slug
     * @return GameItemInterface
     */
    public function setSlug(string $slug): GameItemInterface;

    /**
     * @return int|null
     */
    public function getBasePrice(): ?int;

    /**
     * @param int|null $basePrice
     * @return GameItemInterface
     */
    public function setBasePrice(?int $basePrice): GameItemInterface;

    /**
     * @return int|null
     */
    public function getWidth(): ?int;

    /**
     * @param int|null $width
     * @return GameItemInterface
     */
    public function setWidth(?int $width): GameItemInterface;

    /**
     * @return int|null
     */
    public function getHeight(): ?int;

    /**
     * @param int|null $height
     * @return GameItemInterface
     */
    public function setHeight(?int $height): GameItemInterface;

    /**
     * @return string|null
     */
    public function getBackgroundColor(): ?string;

    /**
     * @param string|null $backgroundColor
     * @return GameItemInterface
     */
    public function setBackgroundColor(?string $backgroundColor): GameItemInterface;

    /**
     * @return float|null
     */
    public function getAccuracyModifier(): ?float;

    /**
     * @param float|null $accuracyModifier
     * @return GameItemInterface
     */
    public function setAccuracyModifier(?float $accuracyModifier): GameItemInterface;

    /**
     * @return float|null
     */
    public function getRecoilModifier(): ?float;

    /**
     * @param float|null $recoilModifier
     * @return GameItemInterface
     */
    public function setRecoilModifier(?float $recoilModifier): GameItemInterface;

    /**
     * @return float|null
     */
    public function getErgonomicsModifier(): ?float;

    /**
     * @param float|null $ergonomicsModifier
     * @return GameItemInterface
     */
    public function setErgonomicsModifier(?float $ergonomicsModifier): GameItemInterface;

    /**
     * @return bool
     */
    public function isHasGrid(): bool;

    /**
     * @param bool $hasGrid
     * @return GameItemInterface
     */
    public function setHasGrid(bool $hasGrid): GameItemInterface;

    /**
     * @return bool
     */
    public function isBlocksHeadphones(): bool;

    /**
     * @param bool $blocksHeadphones
     * @return GameItemInterface
     */
    public function setBlocksHeadphones(bool $blocksHeadphones): GameItemInterface;

    /**
     * @return float|null
     */
    public function getWeight(): ?float;

    /**
     * @param float|null $weight
     * @return GameItemInterface
     */
    public function setWeight(?float $weight): GameItemInterface;

    /**
     * @return float|null
     */
    public function getVelocity(): ?float;

    /**
     * @param float|null $velocity
     * @return GameItemInterface
     */
    public function setVelocity(?float $velocity): GameItemInterface;

    /**
     * @return Collection|null
     */
    public function getUsedInTasks(): ?Collection;

    /**
     * @param Collection|null $usedInTasks
     * @return GameItemInterface
     */
    public function setUsedInTasks(?Collection $usedInTasks): GameItemInterface;

    /**
     * @return Collection|null
     */
    public function getReceivedInTasks(): ?Collection;

    /**
     * @param Collection|null $receivedInTasks
     * @return GameItemInterface
     */
    public function setReceivedInTasks(?Collection $receivedInTasks): GameItemInterface;
}