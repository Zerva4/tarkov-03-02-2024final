<?php

namespace App\Entity\Trader;

use App\Entity\Item\Item;
use App\Entity\Quest\Quest;
use App\Interfaces\Item\ItemInterface;
use App\Interfaces\Quest\QuestInterface;
use App\Interfaces\Trader\TraderCashOfferInterface;
use App\Interfaces\Trader\TraderInterface;
use App\Interfaces\Trader\TraderLevelInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Trader\TraderCashOfferRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Table(name: 'traders_cash_offers')]
#[ORM\Entity(repositoryClass: TraderCashOfferRepository::class)]
class TraderCashOffer implements UuidPrimaryKeyInterface, TimestampableInterface, TraderCashOfferInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;

    #[ORM\ManyToOne(targetEntity: Item::class, inversedBy: 'cashOffers')]
    #[ORM\JoinColumn(name: 'item_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private ?ItemInterface $item;

    #[ORM\ManyToOne(targetEntity: Trader::class, inversedBy: 'cashOffers')]
    #[ORM\JoinColumn(referencedColumnName: 'id', onDelete: 'SET NULL')]
    private ?TraderInterface $trader = null;

    #[ORM\ManyToOne(targetEntity: TraderLevel::class, inversedBy: 'cashOffers')]
    #[ORM\JoinColumn(referencedColumnName: 'id', onDelete: 'SET NULL')]
    private ?TraderLevelInterface $traderLevel = null;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $price;

    #[ORM\Column(type: 'string', length: 10, nullable: false)]
    private string $currency;

    #[ORM\ManyToOne(targetEntity: Item::class, fetch: 'EXTRA_LAZY', inversedBy: 'currencyCashOffers')]
    #[ORM\JoinColumn(name: 'currency_item_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private ?ItemInterface $currencyItem;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $priceRUB;

    #[ORM\ManyToOne(targetEntity: Quest::class, cascade: ['persist'], fetch: 'EXTRA_LAZY', inversedBy: 'unlockInCashOffers')]
    #[ORM\JoinColumn(referencedColumnName: 'id', onDelete: 'SET NULL')]
    private ?QuestInterface $questUnlock = null;

    public function getItem(): ?ItemInterface
    {
        return $this->item;
    }

    public function setItem(?ItemInterface $item): TraderCashOfferInterface
    {
        $this->item = $item;

        return $this;
    }

    public function getTrader(): ?TraderInterface
    {
        return $this->trader;
    }

    public function setTrader(?TraderInterface $trader): TraderCashOfferInterface
    {
        $this->trader = $trader;

        return $this;
    }

    public function getTraderLevel(): ?TraderLevelInterface
    {
        return $this->traderLevel;
    }

    public function setTraderLevel(?TraderLevelInterface $traderLevel): TraderCashOfferInterface
    {
        $this->traderLevel = $traderLevel;

        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): TraderCashOfferInterface
    {
        $this->price = $price;

        return $this;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): TraderCashOfferInterface
    {
        $this->currency = $currency;

        return $this;
    }

    public function getCurrencyItem(): ?ItemInterface
    {
        return $this->currencyItem;
    }

    public function setCurrencyItem(?ItemInterface $currencyItem): TraderCashOfferInterface
    {
        $this->currencyItem = $currencyItem;

        return $this;
    }

    public function getPriceRUB(): int
    {
        return $this->priceRUB;
    }

    public function setPriceRUB(int $priceRUB): TraderCashOfferInterface
    {
        $this->priceRUB = $priceRUB;

        return $this;
    }

    public function getQuestUnlock(): ?QuestInterface
    {
        return $this->questUnlock;
    }

    public function setQuestUnlock(?QuestInterface $questUnlock): TraderCashOfferInterface
    {
        $this->questUnlock = $questUnlock;

        return $this;
    }
}
