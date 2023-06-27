<?php

declare(strict_types=1);

namespace App\Interfaces\Quest;

use App\Interfaces\BarterInterface;
use App\Interfaces\Item\ContainedItemInterface;
use App\Interfaces\Item\ItemInterface;
use App\Interfaces\MapInterface;
use App\Interfaces\Trader\TraderCashOfferInterface;
use App\Interfaces\Trader\TraderInterface;
use App\Interfaces\Workshop\CraftInterface;
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
    public function getUnlockInBarter(): ?Collection;

    /**
     * @param Collection|null $unlockInBarter
     * @return QuestInterface
     */
    public function setUnlockInBarter(?Collection $unlockInBarter): QuestInterface;

    /**
     * @param BarterInterface $barter
     * @return QuestInterface
     */
    public function addUnlockInBarter(BarterInterface $barter): QuestInterface;

    /**
     * @param BarterInterface $barter
     * @return QuestInterface
     */
    public function removeUnlockInBarter(BarterInterface $barter): QuestInterface;

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
     * @param ContainedItemInterface $item
     * @return QuestInterface
     */
    public function addUsedItem(ContainedItemInterface $item): QuestInterface;

    /**
     * @param ContainedItemInterface $item
     * @return QuestInterface
     */
    public function removeUsedItem(ContainedItemInterface $item): QuestInterface;

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
     * @param ContainedItemInterface $item
     * @return QuestInterface
     */
    public function addReceivedItem(ContainedItemInterface $item): QuestInterface;

    /**
     * @param ContainedItemInterface $item
     * @return QuestInterface
     */
    public function removeReceivedItem(ContainedItemInterface $item): QuestInterface;

    /**
     * @return Collection
     */
    public function getUnlockInCrafts(): Collection;

    /**
     * @param Collection $unlockInCrafts
     * @return QuestInterface
     */
    public function setUnlockInCrafts(Collection $unlockInCrafts): QuestInterface;

    /**
     * @param CraftInterface $craft
     * @return QuestInterface
     */
    public function addUnlockInCraft(CraftInterface $craft): QuestInterface;

    /**
     * @param CraftInterface $craft
     * @return QuestInterface
     */
    public function removeUnlockInCraft(CraftInterface $craft): QuestInterface;

    public function getUnlockInCashOffers(): Collection;

    /**
     * @param Collection $unlockInCashOffers
     * @return QuestInterface
     */
    public function setUnlockInCashOffers(Collection $unlockInCashOffers): QuestInterface;

    /**
     * @param TraderCashOfferInterface $cashOffer
     * @return QuestInterface
     */
    public function addUnlockInCashOffer(TraderCashOfferInterface $cashOffer): QuestInterface;

    /**
     * @param TraderCashOfferInterface $cashOffer
     * @return QuestInterface
     */
    public function removeUnlockInCashOffer(TraderCashOfferInterface $cashOffer): QuestInterface;

    /**
     * @return Collection|null
     */
    public function getNeededKeys(): ?Collection;

    /**
     * @param Collection|null $neededKeys
     * @return QuestInterface
     */
    public function setNeededKeys(?Collection $neededKeys): QuestInterface;

    /**
     * @param QuestKeyInterface $questKey
     * @return QuestInterface
     */
    public function addNeededKey(QuestKeyInterface $questKey): QuestInterface;

    /**
     * @param QuestKeyInterface $questKey
     * @return QuestInterface
     */
    public function removeNeededKey(QuestKeyInterface $questKey): QuestInterface;
}