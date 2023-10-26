<?php

declare(strict_types=1);

namespace App\Interfaces\Trader;

interface TraderStandingInterface
{
    public function getTrader(): TraderInterface;
    public function setTrader(TraderInterface $trader): TraderStandingInterface;
    public function getStanding(): float;
    public function setStanding(float $standing): TraderStandingInterface;
}