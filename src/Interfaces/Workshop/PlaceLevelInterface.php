<?php

namespace App\Interfaces\Workshop;
use App\Interfaces\Item\ContainedItemInterface;
use App\Interfaces\SkillInterface;
use App\Interfaces\Trader\TraderRequiredInterface;
use Doctrine\Common\Collections\Collection;

interface PlaceLevelInterface
{
    /**
     * The method return imported API ID from GraphQL.
     *
     * @return string|null
     */
    public function getApiId(): ?string;

    /**
     * The method set API ID.
     *
     * @param string|null $apiId
     * @return PlaceLevelInterface
     */
    public function setApiId(?string $apiId): PlaceLevelInterface;

    /**
     * The method checks the publication status of an entity.
     *
     * @return bool
     */
    public function isPublished(): bool;

    /**
     * @param bool $published
     * @return PlaceLevelInterface
     */
    public function setPublished(bool $published): PlaceLevelInterface;

    /**
     * @return int
     */
    public function getLevelOrder(): int;

    /**
     * @param int $order
     * @return PlaceLevelInterface
     */
    public function setLevelOrder(int $order = 0): PlaceLevelInterface;

    /**
     * @return int
     */
    public function getLevel(): int;

    /**
     * @param int $level
     * @return PlaceLevelInterface
     */
    public function setLevel(int $level = 0): PlaceLevelInterface;

    /**
     * @return int
     */
    public function getConstructionTime(): int;

    /**
     * @param int $constructionTime
     * @return PlaceLevelInterface
     */
    public function setConstructionTime(int $constructionTime): PlaceLevelInterface;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @param string $description
     * @return PlaceLevelInterface
     */
    public function setDescription(string $description): PlaceLevelInterface;

    /**
     * @return PlaceInterface|null
     */
    public function getPlace(): ?PlaceInterface;

    /**
     * @param PlaceInterface|null $place
     * @return PlaceLevelInterface
     */
    public function setPlace(?PlaceInterface $place): PlaceLevelInterface;

    /**
     * @param PlaceInterface $place
     * @return PlaceLevelInterface
     */
    public function addPlace(PlaceInterface $place): PlaceLevelInterface;

    /**
     * @param PlaceInterface $place
     * @return PlaceLevelInterface
     */
    public function removePlace(PlaceInterface $place): PlaceLevelInterface;

    /**
     * @return Collection
     */
    public function getRequiredItems(): Collection;

    /**
     * @param Collection $requiredItems
     * @return PlaceLevelInterface
     */
    public function setRequiredItems(Collection $requiredItems): PlaceLevelInterface;

    /**
     * @param ContainedItemInterface $item
     * @return PlaceLevelInterface
     */
    public function addRequiredItem(ContainedItemInterface $item): PlaceLevelInterface;

    /**
     * @param ContainedItemInterface $item
     * @return PlaceLevelInterface
     */
    public function removeRequiredItem(ContainedItemInterface $item): PlaceLevelInterface;

    /**
     * @return Collection
     */
    public function getRequiredPlacesLevels(): Collection;

    /**
     * @param Collection $requiredPlacesLevels
     * @return PlaceLevelInterface
     */
    public function setRequiredPlacesLevels(Collection $requiredPlacesLevels): PlaceLevelInterface;

    /**
     * @param PlaceLevelRequiredInterface $requiredPlaceLevel
     * @return PlaceLevelInterface
     */
    public function addRequiredPlaceLevel(PlaceLevelRequiredInterface $requiredPlaceLevel): PlaceLevelInterface;

    /**
     * @param PlaceLevelRequiredInterface $requiredPlaceLevel
     * @return PlaceLevelInterface
     */
    public function removeRequiredPlaceLevel(PlaceLevelRequiredInterface $requiredPlaceLevel): PlaceLevelInterface;

    /**
     * @return Collection
     */
    public function getRequiredSkills(): Collection;

    /**
     * @param Collection $requiredSkills
     * @return PlaceLevelInterface
     */
    public function setRequiredSkills(Collection $requiredSkills): PlaceLevelInterface;

    /**
     * @param SkillInterface $skill
     * @return PlaceLevelInterface
     */
    public function addRequiredSkill(SkillInterface $skill): PlaceLevelInterface;

    /**
     * @param SkillInterface $skill
     * @return PlaceLevelInterface
     */
    public function removeRequiredSkill(SkillInterface $skill): PlaceLevelInterface;

    public function getRequiredTraders(): Collection;

    public function setRequiredTraders(Collection $requiredTraders): PlaceLevelInterface;

    public function addRequiredTrader(TraderRequiredInterface $trader): PlaceLevelInterface;

    public function removeRequiredTrader(TraderRequiredInterface $trader): PlaceLevelInterface;
}