<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Entity\Trader;
use Ramsey\Uuid\UuidInterface;

/**
 * Interface for TraderLoyalty entity.
 */
interface TraderLoyaltyInterface
{
    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface;

    /**
     * @param UuidInterface $id
     * @return void
     */
    public function setId(UuidInterface $id): void;

    /**
     * @return int
     */
    public function getLevel(): int;

    /**
     * @param int $level
     * @return TraderLoyaltyInterface
     */
    public function setLevel(int $level): TraderLoyaltyInterface;

    /**
     * @return int
     */
    public function getRequiredLevel(): int;

    /**
     * @param int $level
     * @return TraderLoyaltyInterface
     */
    public function setRequiredLevel(int $level): TraderLoyaltyInterface;

    /**
     * @return float
     */
    public function getRequiredReputation(): float;

    /**
     * @param float $reputation
     * @return TraderLoyaltyInterface
     */
    public function setRequiredReputation(float $reputation): TraderLoyaltyInterface;

    /**
     * @return int
     */
    public function getRequiredSales(): int;

    /**
     * @param int $sales
     * @return TraderLoyaltyInterface
     */
    public function setRequiredSales(int $sales): TraderLoyaltyInterface;

    /**
     * @return TraderInterface
     */
    public function getTrader(): TraderInterface;

    /**
     * @param TraderInterface|null $trader
     * @return TraderLoyaltyInterface
     */
    public function setTrader(?TraderInterface $trader): TraderLoyaltyInterface;
}