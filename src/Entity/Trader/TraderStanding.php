<?php

declare(strict_types=1);

namespace App\Entity\Trader;

use App\Entity\Quest\Quest;
use App\Interfaces\Quest\QuestInterface;
use App\Interfaces\Trader\TraderInterface;
use App\Interfaces\Trader\TraderStandingInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Trader\TraderStandingRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'traders_standings')]
#[ORM\Entity(repositoryClass: TraderStandingRepository::class)]
class TraderStanding implements TraderStandingInterface, UuidPrimaryKeyInterface
{
    use UuidPrimaryKeyTrait;

    #[ORM\ManyToOne(targetEntity: Quest::class, inversedBy: 'neededKeys')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?QuestInterface $quest;

    #[ORM\ManyToOne(targetEntity: Trader::class, inversedBy: 'neededKeys')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private TraderInterface $trader;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0 ])]
    private float $standing;

    public function getTrader(): TraderInterface
    {
        return $this->trader;
    }

    public function setTrader(TraderInterface $trader): TraderStandingInterface
    {
        $this->trader = $trader;

        return $this;
    }

    public function getStanding(): float
    {
        return $this->standing;
    }

    public function setStanding(float $standing): TraderStandingInterface
    {
        $this->standing = $standing;

        return $this;
    }
}
