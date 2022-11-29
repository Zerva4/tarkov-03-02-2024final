<?php

namespace App\Interfaces;

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
}