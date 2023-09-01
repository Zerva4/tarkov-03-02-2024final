<?php

declare(strict_types=1);

namespace App\Interfaces\Item;

use App\Interfaces\BarterInterface;
use App\Interfaces\Quest\QuestInterface;
use App\Interfaces\Workshop\CraftInterface;
use App\Interfaces\Workshop\PlaceLevelInterface;
use Doctrine\Common\Collections\Collection;

interface ContainedItemInterface
{
    public function getApiId(): ?string;
    public function setApiId(?string $apiId): ContainedItemInterface;
    public function getItem(): ?ItemInterface;
    public function setItem(?ItemInterface $item): ContainedItemInterface;
    public function getCount(): ?float;
    public function setCount(?float $count): ContainedItemInterface;
    public function getQuantity(): ?float;
    public function setQuantity(?float $quantity): ContainedItemInterface;
    public function getAttributes(): ?array;
    public function setAttributes(?array $attributes): ContainedItemInterface;
    public function getRequiredInBarters(): Collection;
    public function setRequiredInBarters(Collection $requiredInBarters): ContainedItemInterface;
    public function addRequiredInBarter(BarterInterface $barter): ContainedItemInterface;
    public function removeRequiredInBarter(BarterInterface $barter): ContainedItemInterface;
    public function getRewardInBarters(): Collection;
    public function setRewardInBarters(Collection $rewardInBarters): ContainedItemInterface;
    public function addRewardInBarter(BarterInterface $barter): ContainedItemInterface;
    public function removeRewardInBarter(BarterInterface $barter): ContainedItemInterface;
    public function getRequiredForPlacesLevels(): Collection;
    public function setRequiredForPlacesLevels(Collection $requiredForPlacesLevels): ContainedItemInterface;
    public function addRequiredForPlacesLevel(PlaceLevelInterface $placeLevel): ContainedItemInterface;
    public function removeRequiredForPlacesLevel(PlaceLevelInterface $placeLevel): ContainedItemInterface;
    public function getRequiredInCrafts(): Collection;
    public function setRequiredInCrafts(Collection $requiredInCrafts): ContainedItemInterface;
    public function addRequiredInCraft(CraftInterface $craft): ContainedItemInterface;
    public function removeRequiredInCraft(CraftInterface $craft): ContainedItemInterface;
    public function getRewardInCrafts(): Collection;
    public function setRewardInCrafts(Collection $rewardInCrafts): ContainedItemInterface;
    public function addRewardInCraft(CraftInterface $craft): ContainedItemInterface;
    public function removeRewardInCraft(CraftInterface $craft): ContainedItemInterface;
    public function getUsedInQuests(): ?Collection;
    public function setUsedInQuests(?Collection $usedInQuests): ContainedItemInterface;
    public function addUsedInQuest(QuestInterface $quest): ContainedItemInterface;
    public function removeUsedInQuest(QuestInterface $quest): ContainedItemInterface;
    public function getReceivedFromQuests(): ?Collection;
    public function setReceivedFromQuests(?Collection $receivedFromQuests): ContainedItemInterface;
    public function addReceivedFromQuest(QuestInterface $quest): ContainedItemInterface;
    public function removeReceivedFromQuest(QuestInterface $quest): ContainedItemInterface;
}