<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\LocationRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

#[ORM\Table(name: 'Locations')]
#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location implements TranslatableInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TranslatableTrait;
    use TimestampableTrait;

    #[ORM\Column(type: 'boolean')]
    private bool $published;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $imageName;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private ?string $numberOfPlayers;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $raidDuration;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        $this->defaultLocale = $defaultLocation;
    }

    public function isPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): self
    {
        $this->published = $published;

        return $this;
    }

    public function getNumberOfPlayers(): ?string
    {
        return $this->numberOfPlayers;
    }

    public function setNumberOfPlayers(?string $numberOfPlayers): self
    {
        $this->numberOfPlayers = $numberOfPlayers;

        return $this;
    }

    public function getRaidDuration(): ?float
    {
        return $this->raidDuration;
    }

    public function setRaidDuration(?float $raidDuration): self
    {
        $this->raidDuration = $raidDuration;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @param string|null $imageName
     */
    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }
}
