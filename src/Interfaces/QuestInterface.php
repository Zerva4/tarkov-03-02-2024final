<?php

declare(strict_types=1);

namespace App\Interfaces;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Interface for Quest entity.
 */
interface QuestInterface
{
    /**
     * @return string|null
     */
    public function getApiId(): ?string;

    /**
     * @param string $apiId
     * @return QuestInterface
     */
    public function setApiId(string $apiId): QuestInterface;

    /**
     * @return int
     */
    public function getPosition(): int;

    /**
     * @param int $position
     * @return QuestInterface
     */
    public function setPosition(int $position): QuestInterface;

    /**
     * @return bool|null
     */
    public function isPublished(): ?bool;

    /**
     * @param bool $published
     * @return QuestInterface
     */
    public function setPublished(bool $published): QuestInterface;

    /**
     * @return string|null
     */
    public function getImageName(): ?string;

    /**
     * @param string|null $imageName
     * @return QuestInterface
     */
    public function setImageName(?string $imageName): QuestInterface;

    /**
     * @return TraderInterface|null
     */
    public function getTrader(): ?TraderInterface;

    /**
     * @param TraderInterface|null $trader
     * @return QuestInterface
     */
    public function setTrader(?TraderInterface $trader): QuestInterface;

    /**
     * @return MapInterface|null
     */
    public function getMap(): ?MapInterface;

    /**
     * @return BarterInterface|null
     */
    public function getUnlockInBarter(): ?BarterInterface;

    /**
     * @param BarterInterface|null $unlockInBarter
     * @return QuestInterface
     */
    public function setUnlockInBarter(?BarterInterface $unlockInBarter): QuestInterface;

    /**
     * @param MapInterface|null $map
     * @return QuestInterface
     */
    public function setMap(?MapInterface $map): QuestInterface;

    /**
     * @return File|null
     */
    public function getImageFile(): ?File;

    /**
     * @param File|null $imageFile
     * @return QuestInterface
     */
    public function setImageFile(?File $imageFile): QuestInterface;

    /**
     * @return Collection
     */
    public function getObjectives(): Collection;

    /**
     * @param Collection $objectives
     * @return QuestInterface
     */
    public function setObjectives(Collection $objectives): QuestInterface;

    /**
     * @param QuestObjectiveInterface ...$objectives
     * @return QuestInterface
     */
    public function addObjective(QuestObjectiveInterface ...$objectives): QuestInterface;

    /**
     * @param QuestObjectiveInterface $objective
     * @return QuestInterface
     */
    public function removeObjective(QuestObjectiveInterface $objective): QuestInterface;

    /**
     * @return int|null
     */
    public function getExperience(): ?int;

    /**
     * @param int|null $experience
     * @return QuestInterface
     */
    public function setExperience(?int $experience): QuestInterface;

    /**
     * @return int
     */
    public function getMinPlayerLevel(): int;

    /**
     * @param int $minPlayerLevel
     * @return QuestInterface
     */
    public function setMinPlayerLevel(int $minPlayerLevel): QuestInterface;

    /**
     * @return Collection|null
     */
    public function getUsedItems(): ?Collection;

    /**
     * @param Collection|null $usedItems
     * @return QuestInterface
     */
    public function setUsedItems(?Collection $usedItems): QuestInterface;

    /**
     * @param ItemInterface $item
     * @return QuestInterface
     */
    public function addUsedItem(ItemInterface $item): QuestInterface;

    /**
     * @param ItemInterface $item
     * @return QuestInterface
     */
    public function removeUsedItem(ItemInterface $item): QuestInterface;

    /**
     * @return Collection|null
     */
    public function getReceivedItems(): ?Collection;

    /**
     * @param Collection|null $receivedItems
     * @return QuestInterface
     */
    public function setReceivedItems(?Collection $receivedItems): QuestInterface;

    /**
     * @param ItemInterface $item
     * @return QuestInterface
     */
    public function addReceivedItem(ItemInterface $item): QuestInterface;

    /**
     * @param ItemInterface $item
     * @return QuestInterface
     */
    public function removeReceivedItem(ItemInterface $item): QuestInterface;
}