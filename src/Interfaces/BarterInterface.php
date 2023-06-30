<?php

namespace App\Interfaces;
use App\Interfaces\Item\ContainedItemInterface;
use App\Interfaces\Quest\QuestInterface;
use App\Interfaces\Trader\TraderInterface;
use Doctrine\Common\Collections\Collection;

interface BarterInterface
{
    public function getApiId(): string;
    public function setApiId(string $apiId): BarterInterface;
    public function isPublished(): bool;
    public function setPublished(bool $published): BarterInterface;
    public function getTrader(): ?TraderInterface;
    public function setTrader(TraderInterface $trader): BarterInterface;
    public function getTraderLevel(): int;
    public function setTraderLevel(int $traderLevel): BarterInterface;
    public function getUnlockInQuest(): ?QuestInterface;
    public function setUnlockInQuest(?QuestInterface $quest): BarterInterface;
    public function getRequiredItems(): Collection;
    public function addRequiredItem(ContainedItemInterface $item): BarterInterface;
    public function removeRequiredItem(ContainedItemInterface $item): BarterInterface;
    public function setRequiredItems(Collection $requiredItems): BarterInterface;
    public function getRewardItems(): Collection;
    public function setRewardItems(Collection $rewardItems): BarterInterface;
    public function addRewardItem(ContainedItemInterface $item): BarterInterface;
    public function removeRewardItem(ContainedItemInterface $item): BarterInterface;
}