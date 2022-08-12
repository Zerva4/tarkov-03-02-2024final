<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\TraderInterface;
use App\Interfaces\TraderLoyaltyInterface;
use App\Repository\TraderLoyaltyRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Table(name: 'traders_loyalty')]
#[ORM\Entity(repositoryClass: TraderLoyaltyRepository::class)]
#[ORM\HasLifecycleCallbacks]
class TraderLevel implements TraderLoyaltyInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $level;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $requiredLevel = 0;

    #[ORM\Column(type: 'float', nullable: false)]
    private float $requiredReputation = 0.0;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $requiredSales = 0;

    #[ORM\ManyToOne(targetEntity: Trader::class, inversedBy: 'loyalty')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private TraderInterface $trader;

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): TraderLoyaltyInterface
    {
        $this->level = $level;

        return $this;
    }

    public function getRequiredLevel(): int
    {
        return $this->requiredLevel;
    }

    public function setRequiredLevel(int $level): TraderLoyaltyInterface
    {
        $this->requiredLevel = $level;

        return $this;
    }

    public function getRequiredReputation(): float
    {
        return $this->requiredReputation;
    }

    public function setRequiredReputation(float $reputation): TraderLoyaltyInterface
    {
        $this->requiredReputation = $reputation;

        return $this;
    }

    public function getRequiredSales(): int
    {
        return $this->requiredSales;
    }

    public function setRequiredSales(int $sales): TraderLoyaltyInterface
    {
        $this->requiredSales = $sales;

        return $this;
    }

    public function getTrader(): TraderInterface
    {
        return $this->trader;
    }

    public function setTrader(TraderInterface $trader): TraderLoyaltyInterface
    {
        $this->trader = $trader;

        return $this;
    }

    public function __toString(): string
    {
        return (string)$this->getLevel();
    }
}
