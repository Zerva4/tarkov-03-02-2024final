<?php

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

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: Boss::class, inversedBy: 'health')]
    private BossInterface $boss;

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->published;
    }


    public function getPublished(): bool
    {
        return $this->published;
    }

    /**
     * @param bool $published
     * @return BossHealthInterface
     */
    public function setPublished(bool $published): BossHealthInterface
    {
        $this->published = $published;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getMax(): ?int
    {
        return $this->max;
    }

    /**
     * @param int|null $max
     * @return BossHealthInterface
     */
    public function setMax(?int $max): BossHealthInterface
    {
        $this->max = $max;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return BossHealthInterface
     */
    public function setName(string $name): BossHealthInterface
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return BossInterface
     */
    public function getBoss(): BossInterface
    {
        return $this->boss;
    }

    /**
     * @param BossInterface $boss
     * @return BossHealthInterface
     */
    public function setBoss(BossInterface $boss): BossHealthInterface
    {
        $this->boss = $boss;

        return $this;
    }
}
