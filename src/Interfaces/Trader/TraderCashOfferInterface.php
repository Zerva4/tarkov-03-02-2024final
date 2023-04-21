<?php

namespace App\Interfaces\Trader;

use App\Interfaces\Item\ItemInterface;
use App\Interfaces\Quest\QuestInterface;

interface TraderCashOfferInterface
{
    public function getItem(): ?ItemInterface;
    public function setItem(?ItemInterface $item): TraderCashOfferInterface;
    public function getTraderLevel(): TraderLevelInterface;
    public function setTraderLevel(TraderLevelInterface $traderLevel): TraderCashOfferInterface;
    public function getPrice(): int;
    public function setPrice(int $price): TraderCashOfferInterface;
    public function getCurrency(): string;
    public function setCurrency(string $currency): TraderCashOfferInterface;
    public function getCurrencyItem(): ?ItemInterface;
    public function setCurrencyItem(?ItemInterface $currencyItem): TraderCashOfferInterface;
    public function getPriceRUB(): int;
    public function setPriceRUB(int $priceRUB): TraderCashOfferInterface;
    public function getQuestUnlock(): ?QuestInterface;
    public function setQuestUnlock(?QuestInterface $questUnlock): TraderCashOfferInterface;
}