<?php

declare(strict_types=1);

namespace App\Interfaces\Trader;

use App\Interfaces\Quest\QuestInterface;

interface TraderStandingInterface
{
    public function getApiId(): string;
    public function setApiId(string $apiId): TraderStandingInterface;
    public function getQuest(): ?QuestInterface;
    public function setQuest(?QuestInterface $quest): TraderStandingInterface;
    public function getTrader(): TraderInterface;
    public function setTrader(TraderInterface $trader): TraderStandingInterface;
    public function getStanding(): float;
    public function setStanding(float $standing): TraderStandingInterface;
}