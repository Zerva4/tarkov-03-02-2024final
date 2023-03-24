<?php

namespace App\Entity\Item;

use App\Entity\Barter;
use App\Entity\Workshop\Craft;
use App\Entity\Workshop\PlaceLevel;
use App\Interfaces\BarterInterface;
use App\Interfaces\Item\ContainedItemInterface;
use App\Interfaces\Item\ItemInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Interfaces\Workshop\CraftInterface;
use App\Interfaces\Workshop\PlaceLevelInterface;
use App\Repository\Item\ContainedItemRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Table(name: 'contained_items')]
#[ORM\Index(columns: ['api_id'], name: 'contained_item_idx')]
#[ORM\Entity(repositoryClass: ContainedItemRepository::class)]
class ContainedItem implements UuidPrimaryKeyInterface, TimestampableInterface, ContainedItemInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: true, options: ['default' => null])]
    private ?string $apiId = null;

    #[ORM\ManyToOne(targetEntity: Item::class, cascade: ['persist'], fetch: 'EXTRA_LAZY', inversedBy: 'containedItems')]
    #[ORM\JoinColumn(referencedColumnName: 'id', onDelete: 'SET NULL')]
    private ?ItemInterface $item;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $count = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $quantity = null;

    #[ORM\Column(type: 'json', nullable: true, options: ["jsonb" => true])]
    private ?array $attributes = null;

    #[ORM\ManyToMany(targetEntity: Barter::class, mappedBy: 'requiredItems', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    #[ORM\JoinTable(name: 'barters_required_items')]
    private Collection $requiredInBarters;

    #[ORM\ManyToMany(targetEntity: Barter::class, mappedBy: 'rewardItems', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    #[ORM\JoinTable(name: 'barters_reward_items')]
    private Collection $rewardInBarters;

    #[ORM\ManyToMany(targetEntity: PlaceLevel::class, mappedBy: 'requiredItems', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    #[ORM\JoinTable(name: 'places_levels_required_items')]
    private Collection $requiredForPlacesLevels;

    #[ORM\ManyToMany(targetEntity: Craft::class, mappedBy: 'requiredContainedItems', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    #[ORM\JoinTable(name: 'crafts_required_contained_items')]
    private Collection $requiredInCrafts;

    #[ORM\ManyToMany(targetEntity: Craft::class, mappedBy: 'rewardContainedItems', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    #[ORM\JoinTable(name: 'crafts_reward_contained_items')]
    private Collection $rewardInCrafts;

    public function __construct()
    {
        $this->requiredInBarters = new ArrayCollection();
        $this->rewardInBarters = new ArrayCollection();
        $this->requiredForPlacesLevels = new ArrayCollection();
    }

    public function getApiId(): ?string
    {
        return $this->apiId;
    }

    public function setApiId(?string $apiId): ContainedItemInterface
    {
        $this->apiId = $apiId;

        return $this;
    }

    public function getItem(): ?ItemInterface
    {
        return $this->item;
    }

    public function setItem(?ItemInterface $item): ContainedItemInterface
    {
        $this->item = $item;

        return $this;
    }

    public function getCount(): ?float
    {
        return $this->count;
    }

    public function setCount(?float $count): ContainedItemInterface
    {
        $this->count = $count;

        return $this;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(?float $quantity): ContainedItemInterface
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getAttributes(): ?array
    {
        return $this->attributes;
    }

    public function setAttributes(?array $attributes): ContainedItemInterface
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function getRequiredInBarters(): Collection
    {
        return $this->requiredInBarters;
    }

    public function setRequiredInBarters(Collection $requiredInBarters): ContainedItemInterface
    {
        $this->requiredInBarters = $requiredInBarters;

        return $this;
    }

    public function addRequiredInBarter(BarterInterface $barter): ContainedItemInterface
    {
        if (!$this->requiredInBarters->contains($barter)) {
            $this->requiredInBarters->add($barter);
            $barter->addRequiredItem($this);
        }

        return $this;
    }

    public function removeRequiredInBarter(BarterInterface $barter): ContainedItemInterface
    {
        if ($this->requiredInBarters->contains($barter)) {
            $this->requiredInBarters->removeElement($barter);
            $barter->removeRequiredItem($this);
        }

        return $this;
    }

    public function getRewardInBarters(): Collection
    {
        return $this->rewardInBarters;
    }

    public function setRewardInBarters(Collection $rewardInBarters): ContainedItemInterface
    {
        $this->rewardInBarters = $rewardInBarters;

        return $this;
    }

    public function addRewardInBarter(BarterInterface $barter): ContainedItemInterface
    {
        if (!$this->rewardInBarters->contains($barter)) {
            $this->rewardInBarters->add($barter);
            $barter->addRewardItem($this);
        }

        return $this;
    }

    public function removeRewardInBarter(BarterInterface $barter): ContainedItemInterface
    {
        if ($this->rewardInBarters->contains($barter)) {
            $this->rewardInBarters->removeElement($barter);
            $barter->removeRewardItem($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->item->__get('title');
    }

    public function getRequiredForPlacesLevels(): Collection
    {
        return $this->requiredForPlacesLevels;
    }

    public function setRequiredForPlacesLevels(Collection $requiredForPlacesLevels): ContainedItemInterface
    {
        $this->requiredForPlacesLevels = $requiredForPlacesLevels;

        return $this;
    }

    public function addRequiredForPlacesLevel(PlaceLevelInterface $placeLevel): ContainedItemInterface
    {
        if (!$this->requiredForPlacesLevels->contains($placeLevel)) {
            $this->requiredForPlacesLevels->add($placeLevel);
            $placeLevel->addRequiredItem($this);
        }

        return $this;
    }

    public function removeRequiredForPlacesLevel(PlaceLevelInterface $placeLevel): ContainedItemInterface
    {
        if ($this->requiredForPlacesLevels->contains($placeLevel)) {
            $this->requiredForPlacesLevels->removeElement($placeLevel);
            $placeLevel->removeRequiredItem($this);
        }

        return $this;
    }

    public function getRequiredInCrafts(): Collection
    {
        return $this->requiredInCrafts;
    }

    public function setRequiredInCrafts(Collection $requiredInCrafts): ContainedItemInterface
    {
        $this->requiredInCrafts = $requiredInCrafts;

        return $this;
    }

    public function addRequiredInCraft(CraftInterface $craft): ContainedItemInterface
    {
        if (!$this->requiredInCrafts->contains($craft)) {
            $this->requiredInCrafts->add($craft);
            $craft->addRequiredContainedItem($this);
        }

        return $this;
    }

    public function removeRequiredInCraft(CraftInterface $craft): ContainedItemInterface
    {
        if ($this->requiredInCrafts->contains($craft)) {
            $this->requiredInCrafts->removeElement($craft);
            $craft->removeRequiredContainedItem($this);
        }

        return $this;
    }

    public function getRewardInCrafts(): Collection
    {
        return $this->rewardInCrafts;
    }

    public function setRewardInCrafts(Collection $rewardInCrafts): ContainedItemInterface
    {
        $this->rewardInCrafts = $rewardInCrafts;

        return $this;
    }

    public function addRewardInCraft(CraftInterface $craft): ContainedItemInterface
    {
        if (!$this->rewardInCrafts->contains($craft)) {
            $this->rewardInCrafts->add($craft);
            $craft->addRewardContainedItem($this);
        }

        return $this;
    }

    public function removeRewardInCraft(CraftInterface $craft): ContainedItemInterface
    {
        if ($this->rewardInCrafts->contains($craft)) {
            $this->rewardInCrafts->removeElement($craft);
            $craft->removeRewardContainedItem($this);
        }

        return $this;
    }
}
