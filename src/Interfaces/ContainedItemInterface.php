<?php

namespace App\Interfaces;

use Doctrine\Common\Collections\Collection;

interface ContainedItemInterface
{
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
}