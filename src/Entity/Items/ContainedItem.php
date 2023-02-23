<?php

namespace App\Entity\Items;

use App\Entity\Barter;
use App\Interfaces\BarterInterface;
use App\Interfaces\ContainedItemInterface;
use App\Interfaces\ItemInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\ContainedItemRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Table(name: 'contained_items')]
#[ORM\Entity(repositoryClass: ContainedItemRepository::class)]
class ContainedItem implements UuidPrimaryKeyInterface, TimestampableInterface, ContainedItemInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;

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

    public function __construct()
    {
        $this->requiredInBarters = new ArrayCollection();
        $this->rewardInBarters = new ArrayCollection();
    }

    /**
     * @return ItemInterface|null
     */
    public function getItem(): ?ItemInterface
    {
        return $this->item;
    }

    /**
     * @param ItemInterface|null $item
     * @return ContainedItemInterface
     */
    public function setItem(?ItemInterface $item): ContainedItemInterface
    {
        $this->item = $item;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getCount(): ?float
    {
        return $this->count;
    }

    /**
     * @param float|null $count
     * @return ContainedItemInterface
     */
    public function setCount(?float $count): ContainedItemInterface
    {
        $this->count = $count;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    /**
     * @param float|null $quantity
     * @return ContainedItemInterface
     */
    public function setQuantity(?float $quantity): ContainedItemInterface
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getAttributes(): ?array
    {
        return $this->attributes;
    }

    /**
     * @param array|null $attributes
     * @return ContainedItemInterface
     */
    public function setAttributes(?array $attributes): ContainedItemInterface
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getRequiredInBarters(): Collection
    {
        return $this->requiredInBarters;
    }

    /**
     * @param Collection $requiredInBarters
     * @return ContainedItemInterface
     */
    public function setRequiredInBarters(Collection $requiredInBarters): ContainedItemInterface
    {
        $this->requiredInBarters = $requiredInBarters;

        return $this;
    }

    /**
     * @param BarterInterface $barter
     * @return ContainedItemInterface
     */
    public function addRequiredInBarter(BarterInterface $barter): ContainedItemInterface
    {
        if (!$this->requiredInBarters->contains($barter)) {
            $this->requiredInBarters->add($barter);
            $barter->addRequiredItem($this);
        }

        return $this;
    }

    /**
     * @param BarterInterface $barter
     * @return ContainedItemInterface
     */
    public function removeRequiredInBarter(BarterInterface $barter): ContainedItemInterface
    {
        if ($this->requiredInBarters->contains($barter)) {
            $this->requiredInBarters->removeElement($barter);
            $barter->removeRequiredItem($this);
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getRewardInBarters(): Collection
    {
        return $this->rewardInBarters;
    }

    /**
     * @param Collection $rewardInBarters
     * @return ContainedItemInterface
     */
    public function setRewardInBarters(Collection $rewardInBarters): ContainedItemInterface
    {
        $this->rewardInBarters = $rewardInBarters;

        return $this;
    }

    /**
     * @param BarterInterface $barter
     * @return ContainedItemInterface
     */
    public function addRewardInBarter(BarterInterface $barter): ContainedItemInterface
    {
        if (!$this->rewardInBarters->contains($barter)) {
            $this->rewardInBarters->add($barter);
            $barter->addRewardItem($this);
        }

        return $this;
    }

    /**
     * @param BarterInterface $barter
     * @return ContainedItemInterface
     */
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
}
