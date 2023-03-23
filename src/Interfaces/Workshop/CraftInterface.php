<?php

namespace App\Interfaces\Workshop;

use App\Interfaces\Item\ContainedItemInterface;
use App\Interfaces\Quest\QuestInterface;
use App\Interfaces\Quest\QuestItemInterface;
use Doctrine\Common\Collections\Collection;

interface CraftInterface
{
    /**
     * @return string|null
     */
    public function getApiId(): ?string;

    /**
     * @param string|null $apiId
     * @return CraftInterface
     */
    public function setApiId(?string $apiId): CraftInterface;

    /**
     * @return bool
     */
    public function isPublished(): bool;

    /**
     * @param bool $published
     * @return CraftInterface
     */
    public function setPublished(bool $published): CraftInterface;

    /**
     * @return PlaceInterface|null
     */
    public function getPlace(): ?PlaceInterface;

    /**
     * @param PlaceInterface|null $place
     * @return CraftInterface
     */
    public function setPlace(?PlaceInterface $place): CraftInterface;

    /**
     * @return QuestInterface|null
     */
    public function getQuest(): ?QuestInterface;

    /**
     * @param QuestInterface|null $quest
     * @return CraftInterface
     */
    public function setQuest(?QuestInterface $quest): CraftInterface;

    /**
     * @return int|null
     */
    public function getLevel(): ?int;

    /**
     * @param int|null $level
     * @return CraftInterface
     */
    public function setLevel(?int $level): CraftInterface;

    /**
     * @return int|null
     */
    public function getDuration(): ?int;

    /**
     * @param int|null $duration
     * @return CraftInterface
     */
    public function setDuration(?int $duration): CraftInterface;

    /**
     * @return Collection
     */
    public function getRequiredItems(): Collection;

    /**
     * @param Collection $requiredItems
     * @return CraftInterface
     */
    public function setRequiredItems(Collection $requiredItems): CraftInterface;

    /**
     * @param ContainedItemInterface $requiredItem
     * @return CraftInterface
     */
    public function addRequiredItem(ContainedItemInterface $requiredItem): CraftInterface;

    /**
     * @param ContainedItemInterface $requiredItem
     * @return CraftInterface
     */
    public function removeRequiredItem(ContainedItemInterface $requiredItem): CraftInterface;

    /**
     * @return Collection
     */
    public function getRequiredQuestItems(): Collection;

    /**
     * @param Collection $requiredQuestItems
     * @return CraftInterface
     */
    public function setRequiredQuestItems(Collection $requiredQuestItems): CraftInterface;

    /**
     * @param QuestItemInterface $questItem
     * @return CraftInterface
     */
    public function addRequiredQuestItem(QuestItemInterface $questItem): CraftInterface;

    /**
     * @param QuestItemInterface $questItem
     * @return CraftInterface
     */
    public function removeRequiredQuestItem(QuestItemInterface $questItem): CraftInterface;

    /**
     * @return Collection
     */
    public function getRewardItems(): Collection;

    /**
     * @param Collection $rewardItems
     * @return CraftInterface
     */
    public function setRewardItems(Collection $rewardItems): CraftInterface;

    /**
     * @param ContainedItemInterface $rewardItem
     * @return CraftInterface
     */
    public function addRewardItem(ContainedItemInterface $rewardItem): CraftInterface;

    /**
     * @param ContainedItemInterface $rewardItem
     * @return CraftInterface
     */
    public function removeRewardItem(ContainedItemInterface $rewardItem): CraftInterface;
}