<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Interfaces\Quest\QuestInterface;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;

interface MapInterface
{
    /**
     * @return bool|null
     */
    public function isPublished(): ?bool;

    /**
     * @param bool $published
     * @return MapInterface
     */
    public function setPublished(bool $published): MapInterface;

    /**
     * @return string
     */
    public function getApiId(): string;

    /**
     * @param string $apiId
     * @return MapInterface
     */
    public function setApiId(string $apiId): MapInterface;

    /**
     * @return string|null
     */
    public function getImageName(): ?string;

    /**
     * @param string|null $imageName
     * @return MapInterface
     */
    public function setImageName(?string $imageName): MapInterface;

    /**
     * @return mixed
     */
    public function getImageFile(): mixed;

    /**
     * @param mixed $imageFile
     * @return MapInterface
     */
    public function setImageFile(mixed $imageFile): MapInterface;

    /**
     * @return int
     */
    public function getMinPlayersNumber(): int;

    /**
     * @param int $minPlayersNumber
     * @return MapInterface
     */
    public function setMinPlayersNumber(int $minPlayersNumber): MapInterface;

    /**
     * @return int
     */
    public function getMaxPlayersNumber(): int;

    /**
     * @param int $maxPlayersNumber
     * @return MapInterface
     */
    public function setMaxPlayersNumber(int $maxPlayersNumber): MapInterface;

    /**
     * @return DateTimeInterface|null
     */
    public function getRaidDuration(): ?DateTimeInterface;

    /**
     * @param DateTimeInterface|null $raidDuration
     * @return MapInterface
     */
    public function setRaidDuration(?DateTimeInterface $raidDuration): MapInterface;

    /**
     * @return Collection
     */
    public function getQuests(): Collection;

    /**
     * @param Collection $quests
     * @return MapInterface
     */
    public function setQuests(Collection $quests): MapInterface;

    /**
     * @param QuestInterface $quest
     * @return MapInterface
     */
    public function addQuest(QuestInterface $quest): MapInterface;

    /**
     * @param QuestInterface $quest
     * @return MapInterface
     */
    public function removeQuest(QuestInterface $quest): MapInterface;

    /**
     * @return Collection
     */
    public function getLocations(): Collection;

    /**
     * @param Collection $locations
     * @return MapInterface
     */
    public function setLocations(Collection $locations): MapInterface;

    /**
     * @param MapLocationInterface $location
     * @return MapInterface
     */
    public function addLocation(MapLocationInterface $location): MapInterface;

    /**
     * @param MapLocationInterface $location
     * @return MapInterface
     */
    public function removeLocation(MapLocationInterface $location): MapInterface;
}