<?php

namespace App\Entity\Workshop;

use App\Entity\Item\ContainedItem;
use App\Entity\Skill;
use App\Entity\TranslatableEntity;
use App\Interfaces\Item\ContainedItemInterface;
use App\Interfaces\SkillInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Interfaces\Workshop\PlaceLevelInterface;
use App\Interfaces\Workshop\PlaceLevelRequiredInterface;
use App\Repository\Workshop\PlaceLevelRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Table(name: 'places_levels')]
#[ORM\Index(columns: ['api_id'], name: 'places_levels_api_id_idx')]
#[ORM\Entity(repositoryClass: PlaceLevelRepository::class)]
class PlaceLevel extends TranslatableEntity implements UuidPrimaryKeyInterface, TranslatableInterface, TimestampableInterface, PlaceLevelInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $apiId = null;

    #[ORM\Column(type: 'boolean', nullable: false, options: ['default' => true])]
    private bool $published = true;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0])]
    private int $order = 0;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0])]
    private int $level = 0;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0])]
    private int $constructionTime = 0;

    #[ORM\ManyToMany(targetEntity: ContainedItem::class, inversedBy: 'requiredForPlacesLevels', cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    #[ORM\JoinTable(name: 'places_levels_required_items')]
    private Collection $requiredItems;

    #[ORM\ManyToMany(targetEntity: PlaceLevelRequired::class, inversedBy: 'requiredForPlacesLevels', cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    #[ORM\JoinTable(name: 'places_levels_required_levels')]
    private Collection $requiredPlacesLevels;

    #[ORM\ManyToMany(targetEntity: Skill::class, inversedBy: 'requiredForPlacesLevels', cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    #[ORM\JoinTable(name: 'places_levels_required_skills')]
    private Collection $requiredSkills;

//    #[ORM\ManyToMany(targetEntity: ContainedItem::class, inversedBy: 'requiredForPlacesLevels', cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
//    #[ORM\JoinTable(name: 'places_levels_required_skills')]
//    private Collection $requiredTraders;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        parent::__construct($defaultLocation);

        $this->requiredItems = new ArrayCollection();
        $this->requiredPlacesLevels = new ArrayCollection();
        $this->requiredSkills = new ArrayCollection();
//        $this->requiredTraders = new ArrayCollection();
    }

    public function getApiId(): ?string
    {
        return $this->apiId;
    }

    public function setApiId(?string $apiId): PlaceLevelInterface
    {
        $this->apiId = $apiId;

        return $this;
    }

    public function isPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): PlaceLevelInterface
    {
        $this->published = $published;

        return $this;
    }

    public function getOrder(): int
    {
        return $this->order;
    }

    public function setOrder(int $order = 0): PlaceLevelInterface
    {
        $this->order = $order;

        return $this;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level = 0): PlaceLevelInterface
    {
        $this->level = $level;

        return $this;
    }

    public function getConstructionTime(): int
    {
        return $this->constructionTime;
    }

    public function setConstructionTime(int $constructionTime): PlaceLevelInterface
    {
        $this->constructionTime = $constructionTime;

        return $this;
    }

    public function getRequiredItems(): Collection
    {
        return $this->requiredItems;
    }

    public function setRequiredItems(Collection $requiredItems): PlaceLevelInterface
    {
        $this->requiredItems = $requiredItems;

        return $this;
    }

    public function addRequiredItem(ContainedItemInterface $item): PlaceLevelInterface
    {
        if (!$this->requiredItems->contains($item)) {
            $this->requiredItems->add($item);
            $item->addRequiredForPlacesLevel($this);
        }

        return $this;
    }

    public function removeRequiredItem(ContainedItemInterface $item): PlaceLevelInterface
    {
        if ($this->requiredItems->contains($item)) {
            $this->requiredItems->removeElement($item);
            $item->removeRequiredForPlacesLevel($this);
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getRequiredPlacesLevels(): Collection
    {
        return $this->requiredPlacesLevels;
    }

    /**
     * @param Collection $requiredPlacesLevels
     * @return PlaceLevelInterface
     */
    public function setRequiredPlacesLevels(Collection $requiredPlacesLevels): PlaceLevelInterface
    {
        $this->requiredPlacesLevels = $requiredPlacesLevels;

        return $this;
    }

    public function addRequiredPlaceLevel(PlaceLevelRequiredInterface $requiredPlaceLevel): PlaceLevelInterface
    {
        if (!$this->requiredItems->contains($requiredPlaceLevel)) {
            $this->requiredItems->add($requiredPlaceLevel);
            $requiredPlaceLevel->addRequiredForPlacesLevel($this);
        }

        return $this;
    }

    public function removeRequiredPlaceLevel(PlaceLevelRequiredInterface $requiredPlaceLevel): PlaceLevelInterface
    {
        if ($this->requiredItems->contains($requiredPlaceLevel)) {
            $this->requiredItems->removeElement($requiredPlaceLevel);
            $requiredPlaceLevel->removeRequiredForPlacesLevel($this);
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getRequiredSkills(): Collection
    {
        return $this->requiredSkills;
    }

    public function setRequiredSkills(Collection $requiredSkills): PlaceLevelInterface
    {
        $this->requiredSkills = $requiredSkills;

        return $this;
    }

    public function addRequiredSkill(SkillInterface $skill): PlaceLevelInterface
    {
        if (!$this->requiredSkills->contains($skill)) {
            $this->requiredSkills->add($skill);
            $skill->addRequiredForPlacesLevel($this);
        }

        return $this;
    }

    public function removeRequiredSkill(SkillInterface $skill): PlaceLevelInterface
    {
        if ($this->requiredSkills->contains($skill)) {
            $this->requiredSkills->removeElement($skill);
            $skill->removeRequiredForPlacesLevel($this);
        }

        return $this;
    }
}
