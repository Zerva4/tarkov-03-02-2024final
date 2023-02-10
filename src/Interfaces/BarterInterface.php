<?php

namespace App\Interfaces;
use Doctrine\Common\Collections\Collection;

interface BarterInterface
{
    public function getApiId(): int;
    public function setApiId(int $apiId): BarterInterface;
    public function isPublished(): bool;
    public function setPublished(bool $published): BarterInterface;
    public function getTrader(): ?TraderInterface;
    public function setTrader(TraderInterface $trader): BarterInterface;
    public function getTraderLevel(): int;
    public function setTraderLevel(int $traderLevel): BarterInterface;
    public function getQuestUnlock(): QuestInterface;
    public function setQuestUnlock(?QuestInterface $questUnlock): BarterInterface;
    public function getRequiredItems(): Collection;
    public function addRequiredItem(ItemInterface $item): BarterInterface;
    public function removeRequiredItem(ItemInterface $item): BarterInterface;
    public function setRequiredItems(Collection $requiredItems): BarterInterface;
    public function getRewardItems(): Collection;
    public function setRewardItems(Collection $rewardItems): BarterInterface;
    public function addRewardItem(ItemInterface $item): BarterInterface;
    public function removeRewardItem(ItemInterface $item): BarterInterface;
}