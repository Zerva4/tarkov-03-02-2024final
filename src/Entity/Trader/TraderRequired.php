<?php

namespace App\Entity\Trader;

use App\Entity\Workshop\PlaceLevel;
use App\Interfaces\Trader\TraderInterface;
use App\Interfaces\Trader\TraderRequiredInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Interfaces\Workshop\PlaceLevelInterface;
use App\Repository\Trader\TraderRequiredRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'traders_required')]
#[ORM\Index(columns: ['api_id'], name: 'traders_required_idx')]
#[ORM\Entity(repositoryClass: TraderRequiredRepository::class)]
class TraderRequired implements UuidPrimaryKeyInterface, TraderRequiredInterface
{
    use UuidPrimaryKeyTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $apiId = null;

    #[ORM\ManyToOne(targetEntity: Trader::class, cascade: ['persist'], fetch: 'EXTRA_LAZY', inversedBy: 'requiredTraders')]
    #[ORM\JoinColumn(referencedColumnName: 'id', onDelete: 'SET NULL')]
    private ?TraderInterface $trader = null;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0])]
    private int $level = 0;

    #[ORM\ManyToMany(targetEntity: PlaceLevel::class, mappedBy: 'requiredTraders', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    #[ORM\JoinTable(name: 'places_levels_required_traders')]
    private Collection $requiredForPlacesLevels;

    public function __construct()
    {
        $this->requiredForPlacesLevels = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function getApiId(): ?string
    {
        return $this->apiId;
    }

    /**
     * @param string|null $apiId
     * @return TraderRequiredInterface
     */
    public function setApiId(?string $apiId): TraderRequiredInterface
    {
        $this->apiId = $apiId;

        return $this;
    }

    /**
     * @return TraderInterface|null
     */
    public function getTrader(): ?TraderInterface
    {
        return $this->trader;
    }

    /**
     * @param TraderInterface|null $trader
     * @return TraderRequiredInterface
     */
    public function setTrader(?TraderInterface $trader): TraderRequiredInterface
    {
        $this->trader = $trader;

        return $this;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     * @return TraderRequiredInterface
     */
    public function setLevel(int $level): TraderRequiredInterface
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getRequiredForPlacesLevels(): Collection
    {
        return $this->requiredForPlacesLevels;
    }

    /**
     * @param Collection $requiredForPlacesLevels
     * @return TraderRequiredInterface
     */
    public function setRequiredForPlacesLevels(Collection $requiredForPlacesLevels): TraderRequiredInterface
    {
        $this->requiredForPlacesLevels = $requiredForPlacesLevels;

        return $this;
    }

    public function addRequiredForPlacesLevel(PlaceLevelInterface $placeLevel): TraderRequiredInterface
    {
        if (!$this->requiredForPlacesLevels->contains($placeLevel)) {
            $this->requiredForPlacesLevels->add($placeLevel);
            $placeLevel->addRequiredTrader($this);
        }

        return $this;
    }

    public function removeRequiredForPlacesLevel(PlaceLevelInterface $placeLevel): TraderRequiredInterface
    {
        if ($this->requiredForPlacesLevels->contains($placeLevel)) {
            $this->requiredForPlacesLevels->removeElement($placeLevel);
            $placeLevel->addRequiredTrader($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->trader->__get('characterType') . ': уровень ' . $this->getLevel();
    }
}
