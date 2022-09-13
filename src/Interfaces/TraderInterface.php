<?php

declare(strict_types=1);

namespace App\Interfaces;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;

interface TraderInterface
{
    /**
     * @return string
     */
    public function getApiId(): string;

    /**
     * @param string $apiId
     * @return TraderInterface
     */
    public function setApiId(string $apiId): TraderInterface;

    /**
     * @return int
     */
    public function getPosition(): int;

    /**
     * @param int $position
     * @return TraderInterface
     */
    public function setPosition(int $position): TraderInterface;

    /**
     * @return bool|null
     */
    public function isPublished(): ?bool;

    /**
     * @param bool $published
     * @return TraderInterface
     */
    public function setPublished(bool $published): TraderInterface;

    /**
     * @return string|null
     */
    public function getImageName(): ?string;

    /**
     * @param string|null $imageName
     * @return TraderInterface
     */
    public function setImageName(?string $imageName): TraderInterface;

    /**
     * @return File|null
     */
    public function getImageFile(): ?File;

    /**
     * @param File|null $imageFile
     * @return TraderInterface
     */
    public function setImageFile(?File $imageFile): TraderInterface;

    /**
     * @return Collection
     */
    public function getLevels(): Collection;

    /**
     * @param Collection $level
     * @return TraderInterface
     */
    public function setLevels(Collection $level): TraderInterface;

    /**
     * @param TraderLevelInterface $level
     * @return TraderInterface
     */
    public function addLevel(TraderLevelInterface $level): TraderInterface;

    /**
     * @param TraderLevelInterface $level
     * @return TraderInterface
     */
    public function removeLevel(TraderLevelInterface $level): TraderInterface;

    /**
     * @return Collection
     */
    public function getQuests(): Collection;

    /**
     * @param Collection $quests
     * @return TraderInterface
     */
    public function setQuests(Collection $quests): TraderInterface;

    /**
     * @param QuestInterface $quest
     * @return TraderInterface
     */
    public function addQuest(QuestInterface $quest): TraderInterface;

    /**
     * @param QuestInterface $quest
     * @return TraderInterface
     */
    public function removeQuest(QuestInterface $quest): TraderInterface;
}