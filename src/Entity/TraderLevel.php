<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\TraderInterface;
use App\Interfaces\TraderLevelInterface;
use App\Repository\TraderLevelRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Table(name: 'traders_levels')]
#[ORM\Entity(repositoryClass: TraderLevelRepository::class)]
#[ORM\HasLifecycleCallbacks]
class TraderLevel implements TraderLevelInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $level;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $requiredPlayerLevel = 0;

    #[ORM\Column(type: 'float', nullable: false)]
    private float $requiredReputation = 0.0;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $requiredSales = 0;

    #[ORM\ManyToOne(targetEntity: Trader::class, inversedBy: 'levels')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private TraderInterface $trader;

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): TraderLevelInterface
    {
        $this->level = $level;

        return $this;
    }

    public function getRequiredPlayerLevel(): int
    {
        return $this->requiredPlayerLevel;
    }

    public function setRequiredPlayerLevel(int $level): TraderLevelInterface
    {
        $this->requiredPlayerLevel = $level;

        return $this;
    }

    public function getRequiredReputation(): float
    {
        return $this->requiredReputation;
    }

    public function setRequiredReputation(float $reputation): TraderLevelInterface
    {
        $this->requiredReputation = $reputation;

        return $this;
    }

    public function getRequiredSales(): int
    {
        return $this->requiredSales;
    }

    public function setRequiredSales(int $sales): TraderLevelInterface
    {
        $this->requiredSales = $sales;

        return $this;
    }

    public function getTrader(): TraderInterface
    {
        return $this->trader;
    }

    public function setTrader(TraderInterface $trader): TraderLevelInterface
    {
        $this->trader = $trader;

        return $this;
    }

    public function __toString(): string
    {
        return (string)$this->getLevel();
    }
}
