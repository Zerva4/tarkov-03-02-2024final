<?php

namespace App\Interfaces\Quest;

use App\Interfaces\Workshop\CraftInterface;
use Doctrine\Common\Collections\Collection;

/**
 * Interface for QuestItem entity.
 */
interface QuestItemInterface
{
    /**
     * @return string
     */
    public function getApiId(): string;

    /**
     * @param string $apiId
     * @return QuestItemInterface
     */
    public function setApiId(string $apiId): QuestItemInterface;

    /**
     * @return bool
     */
    public function isPublished(): bool;

    /**
     * @param bool $published
     * @return QuestItemInterface
     */
    public function setPublished(bool $published): QuestItemInterface;

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string $name
     * @return QuestItemInterface
     */
    public function setName(string $name): QuestItemInterface;

    /**
     * @return string|null
     */
    public function getShortName(): ?string;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @param string $description
     * @return QuestItemInterface
     */
    public function setDescription(string $description): QuestItemInterface;

    /**
     * @param string $name
     * @return QuestItemInterface
     */
    public function setShotName(string $name): QuestItemInterface;

    /**
     * @return int|null
     */
    public function getWidth(): ?int;

    /**
     * @param int $width
     * @return QuestItemInterface
     */
    public function setWidth(int $width): QuestItemInterface;

    /**
     * @return int|null
     */
    public function getHeight(): ?int;

    /**
     * @param int $height
     * @return QuestItemInterface
     */
    public function setHeight(int $height): QuestItemInterface;

    /**
     * @return Collection
     */
    public function getRequiredInCrafts(): Collection;

    /**
     * @param Collection $requiredInCrafts
     * @return QuestItemInterface
     */
    public function setRequiredInCrafts(Collection $requiredInCrafts): QuestItemInterface;

    /**
     * @param CraftInterface $craft
     * @return QuestItemInterface
     */
    public function addRequiredInCraft(CraftInterface $craft): QuestItemInterface;

    /**
     * @param CraftInterface $craft
     * @return QuestItemInterface
     */
    public function removeRequiredInCraft(CraftInterface $craft): QuestItemInterface;
}