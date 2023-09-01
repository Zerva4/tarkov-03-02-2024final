<?php

declare(strict_types=1);

namespace App\Entity\Workshop;

use App\Interfaces\UuidPrimaryKeyInterface;
use App\Interfaces\Workshop\PlaceInterface;
use App\Interfaces\Workshop\PlaceLevelInterface;
use App\Interfaces\Workshop\PlaceLevelRequiredInterface;
use App\Repository\Workshop\PlaceLevelRequiredRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'places_levels_required')]
#[ORM\Index(columns: ['api_id'], name: 'places_levels_required_idx')]
#[ORM\Entity(repositoryClass: PlaceLevelRequiredRepository::class)]
class PlaceLevelRequired implements UuidPrimaryKeyInterface, PlaceLevelRequiredInterface
{
    use UuidPrimaryKeyTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $apiId = null;

    #[ORM\ManyToOne(targetEntity: Place::class, cascade: ['persist'], fetch: 'EXTRA_LAZY', inversedBy: 'placeRequiredLevels')]
    #[ORM\JoinColumn(referencedColumnName: 'id', onDelete: 'SET NULL')]
    private ?PlaceInterface $place = null;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0])]
    private int $level = 0;

    #[ORM\ManyToMany(targetEntity: PlaceLevel::class, mappedBy: 'requiredPlacesLevels', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    #[ORM\JoinTable(name: 'places_levels_required_levels')]
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
     * @return PlaceLevelRequiredInterface
     */
    public function setApiId(?string $apiId): PlaceLevelRequiredInterface
    {
        $this->apiId = $apiId;

        return $this;
    }

    /**
     * @return PlaceInterface|null
     */
    public function getPlace(): ?PlaceInterface
    {
        return $this->place;
    }

    /**
     * @param PlaceInterface|null $place
     * @return PlaceLevelRequiredInterface
     */
    public function setPlace(?PlaceInterface $place): PlaceLevelRequiredInterface
    {
        $this->place = $place;

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
     * @return PlaceLevelRequiredInterface
     */
    public function setLevel(int $level): PlaceLevelRequiredInterface
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
     * @return PlaceLevelRequiredInterface
     */
    public function setRequiredForPlacesLevels(Collection $requiredForPlacesLevels): PlaceLevelRequiredInterface
    {
        $this->requiredForPlacesLevels = $requiredForPlacesLevels;

        return $this;
    }

    public function addRequiredForPlacesLevel(PlaceLevelInterface $placeLevel): PlaceLevelRequiredInterface
    {
        if (!$this->requiredForPlacesLevels->contains($placeLevel)) {
            $this->requiredForPlacesLevels->add($placeLevel);
            $placeLevel->addRequiredPlaceLevel($this);
        }

        return $this;
    }

    public function removeRequiredForPlacesLevel(PlaceLevelInterface $placeLevel): PlaceLevelRequiredInterface
    {
        if ($this->requiredForPlacesLevels->contains($placeLevel)) {
            $this->requiredForPlacesLevels->removeElement($placeLevel);
            $placeLevel->removeRequiredPlaceLevel($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->place->__get('title') . ': уровень ' . $this->getLevel();
    }
}
