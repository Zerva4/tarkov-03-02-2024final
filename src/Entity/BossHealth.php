<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\BossHealthInterface;
use App\Interfaces\BossInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\BossHealthRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Table(name: 'bosses_health')]
#[ORM\Entity(repositoryClass: BossHealthRepository::class)]
class BossHealth implements UuidPrimaryKeyInterface, TimestampableInterface, BossHealthInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;

    #[ORM\Column(type: 'boolean')]
    private bool $published;

    #[ORM\Column(nullable: true)]
    private ?int $max = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $name;

    #[ORM\ManyToOne(targetEntity: Boss::class, inversedBy: 'health')]
    private ?BossInterface $boss = null;

    public function isPublished(): bool
    {
        return $this->published;
    }


    public function getPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): BossHealthInterface
    {
        $this->published = $published;

        return $this;
    }

    public function getMax(): ?int
    {
        return $this->max;
    }

    public function setMax(?int $max): BossHealthInterface
    {
        $this->max = $max;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): BossHealthInterface
    {
        $this->name = $name;

        return $this;
    }

    public function getBoss(): BossInterface
    {
        return $this->boss;
    }

    public function setBoss(?BossInterface $boss): BossHealthInterface
    {
        $this->boss = $boss;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
