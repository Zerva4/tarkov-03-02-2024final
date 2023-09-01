<?php

namespace App\Entity\Workshop;

use App\Entity\TranslatableEntity;
use App\Interfaces\Quest\QuestInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Interfaces\Workshop\CraftInterface;
use App\Interfaces\Workshop\PlaceInterface;
use App\Interfaces\Workshop\PlaceLevelInterface;
use App\Interfaces\Workshop\PlaceLevelRequiredInterface;
use App\Repository\Workshop\PlaceRepository;
use App\Traits\SlugTrait;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Table(name: 'places')]
#[ORM\Index(columns: ['slug'], name: 'place_slug_idx')]
#[ORM\Index(columns: ['api_id'], name: 'place_api_id_idx')]
#[ORM\Entity(repositoryClass: PlaceRepository::class)]
class Place extends TranslatableEntity implements UuidPrimaryKeyInterface, TranslatableInterface, TimestampableInterface, PlaceInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;
    use SlugTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $apiId = null;

    #[ORM\Column(type: 'boolean', nullable: false, options: ['default' => true])]
    private bool $published = true;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $orderPlace = null;

    #[ORM\OneToMany(mappedBy: 'place', targetEntity: PlaceLevel::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    #[ORM\JoinColumn(name: 'place_id', referencedColumnName: 'id')]
    #[ORM\OrderBy(['level' => 'ASC'])]
    private Collection $levels;

    #[ORM\OneToMany(mappedBy: 'place', targetEntity: PlaceLevelRequired::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    private Collection $placeRequiredLevels;

    #[ORM\OneToMany(mappedBy: 'place', targetEntity: Craft::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY')]
    private Collection $crafts;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        parent::__construct($defaultLocation);

        $this->levels = new ArrayCollection();
        $this->placeRequiredLevels = new ArrayCollection();
        $this->crafts = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function getApiId(): ?string
    {
        return $this->apiId;
    }

    /**
     * @param string $apiId
     * @return PlaceInterface
     */
    public function setApiId(string $apiId): PlaceInterface
    {
        $this->apiId = $apiId;

        return $this;
    }

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->published;
    }

    /**
     * @param bool $published
     * @return PlaceInterface
     */
    public function setPublished(bool $published): PlaceInterface
    {
        $this->published = $published;

        return $this;
    }

    public function getOrderPlace(): ?int
    {
        return $this->orderPlace;
    }

    public function setOrderPlace(?int $orderPlace): PlaceInterface
    {
        $this->orderPlace = $orderPlace;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->translate()->getName();
    }

    public function setName(string $name): PlaceInterface
    {
        $this->translate()->setName($name);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getLevels(): Collection
    {
        return $this->levels;
    }

    /**
     * @param Collection $levels
     * @return PlaceInterface
     */
    public function setLevels(Collection $levels): PlaceInterface
    {
        $this->levels = $levels;

        return $this;
    }

    /**
     * @param PlaceLevelInterface $level
     * @return PlaceInterface
     */
    public function addLevel(PlaceLevelInterface $level): PlaceInterface
    {
        if (!$this->levels->contains($level)) {
            $this->levels->add($level);
            $level->addPlace($this);
        }

        return $this;
    }

    /**
     * @param PlaceLevelInterface $level
     * @return PlaceInterface
     */
    public function removeLevel(PlaceLevelInterface $level): PlaceInterface
    {
        if ($this->levels->contains($level)) {
            $this->levels->removeElement($level);
            $level->removePlace($this);
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getPlaceRequiredLevels(): Collection
    {
        return $this->placeRequiredLevels;
    }

    /**
     * @param Collection $placeRequiredLevels
     * @return PlaceInterface
     */
    public function setPlaceRequiredLevels(Collection $placeRequiredLevels): PlaceInterface
    {
        $this->placeRequiredLevels = $placeRequiredLevels;

        return $this;
    }

    /**
     * @param PlaceLevelRequiredInterface $placeLevelRequired
     * @return PlaceInterface
     */
    public function addPlaceRequiredLevel(PlaceLevelRequiredInterface $placeLevelRequired): PlaceInterface
    {
        if (!$this->placeRequiredLevels->contains($placeLevelRequired)) {
            $this->placeRequiredLevels->add($placeLevelRequired);
            $placeLevelRequired->setPlace($this);
        }

        return $this;
    }

    /**
     * @param PlaceLevelRequiredInterface $placeLevelRequired
     * @return PlaceInterface
     */
    public function removePlaceRequiredLevel(PlaceLevelRequiredInterface $placeLevelRequired): PlaceInterface
    {
        if (!$this->placeRequiredLevels->contains($placeLevelRequired)) {
            $this->placeRequiredLevels->add($placeLevelRequired);
            $placeLevelRequired->setPlace(null);
        }

        return $this;
    }

    public function getCrafts(): Collection
    {
        return $this->crafts;
    }

    public function setCrafts(Collection $crafts): PlaceInterface
    {
        $this->crafts = $crafts;

        return $this;
    }

    public function addCraft(CraftInterface $craft): PlaceInterface
    {
        if (!$this->crafts->contains($craft)) {
            $this->crafts->add($craft);
            $craft->setPlace($this);
        }

        return $this;
    }

    public function removeCraft(CraftInterface $craft): PlaceInterface
    {
        if ($this->crafts->contains($craft)) {
            $this->crafts->removeElement($craft);
            $craft->setPlace(null);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->__get('title');
    }
}
