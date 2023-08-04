<?php

namespace App\Entity\Workshop;

use App\Entity\Item\ContainedItem;
use App\Entity\Quest\Quest;
use App\Entity\Quest\QuestItem;
use App\Interfaces\Item\ContainedItemInterface;
use App\Interfaces\Quest\QuestInterface;
use App\Interfaces\Quest\QuestItemInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Interfaces\Workshop\CraftInterface;
use App\Interfaces\Workshop\PlaceInterface;
use App\Repository\Workshop\CraftRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Table(name: 'crafts')]
#[ORM\Index(columns: ['api_id'], name: 'craft_api_id_idx')]
#[ORM\Entity(repositoryClass: CraftRepository::class)]
class Craft implements UuidPrimaryKeyInterface, TimestampableInterface, CraftInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $apiId = null;

    #[ORM\Column(type: 'boolean', nullable: false, options: ['default' => true])]
    private bool $published = true;

    #[ORM\ManyToOne(targetEntity: Place::class, cascade: ['persist'], fetch: 'EXTRA_LAZY', inversedBy: 'crafts')]
    #[ORM\JoinColumn(referencedColumnName: 'id', onDelete: 'SET NULL')]
    #[ORM\JoinTable(name: 'crafts_places')]
    private ?PlaceInterface $place = null;

    #[ORM\ManyToOne(targetEntity: Quest::class, cascade: ['persist'], fetch: 'EXTRA_LAZY', inversedBy: 'unlockInCrafts')]
    #[ORM\JoinColumn(referencedColumnName: 'id', onDelete: 'SET NULL')]
    #[ORM\JoinTable(name: 'crafts_unlock_quests')]
    private ?QuestInterface $unlockQuest = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $level = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $duration = null;

    #[ORM\ManyToMany(targetEntity: ContainedItem::class, inversedBy: 'requiredInCrafts', cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    #[ORM\JoinTable(name: 'crafts_required_contained_items')]
    private Collection $requiredContainedItems;

    #[ORM\ManyToMany(targetEntity: QuestItem::class, inversedBy: 'requiredInCrafts', cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    #[ORM\JoinTable(name: 'crafts_required_quest_items')]
    private Collection $requiredQuestItems;

    #[ORM\ManyToMany(targetEntity: ContainedItem::class, inversedBy: 'rewardInCrafts', cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    #[ORM\JoinTable(name: 'crafts_reward_contained_items')]
    private Collection $rewardContainedItems;

    public function __construct()
    {
        $this->requiredContainedItems = new ArrayCollection();
        $this->requiredQuestItems = new ArrayCollection();
        $this->rewardContainedItems = new ArrayCollection();
    }

    public function getApiId(): ?string
    {
        return $this->apiId;
    }

    public function setApiId(?string $apiId): CraftInterface
    {
        $this->apiId = $apiId;

        return $this;
    }

    public function isPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): CraftInterface
    {
        $this->published = $published;

        return $this;
    }

    public function getPlace(): ?PlaceInterface
    {
        return $this->place;
    }

    public function setPlace(?PlaceInterface $place): CraftInterface
    {
        $this->place = $place;

        return $this;
    }

    public function getUnlockQuest(): ?QuestInterface
    {
        return $this->unlockQuest;
    }

    public function setUnlockQuest(?QuestInterface $quest): CraftInterface
    {
        $this->unlockQuest = $quest;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(?int $level): CraftInterface
    {
        $this->level = $level;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): CraftInterface
    {
        $this->duration = $duration;

        return $this;
    }

    public function getRequiredContainedItems(): Collection
    {
        return $this->requiredContainedItems;
    }

    public function setRequiredContainedItems(Collection $containedItems): CraftInterface
    {
        $this->requiredContainedItems = $containedItems;

        return $this;
    }

    public function addRequiredContainedItem(ContainedItemInterface $containedItem): CraftInterface
    {
        if (!$this->requiredContainedItems->contains($containedItem)) {
            $this->requiredContainedItems->add($containedItem);
            $containedItem->addRequiredInCraft($this);
        }

        return $this;
    }

    public function removeRequiredContainedItem(ContainedItemInterface $containedItem): CraftInterface
    {
        if (!$this->requiredContainedItems->contains($containedItem)) {
            $this->requiredContainedItems->removeElement($containedItem);
            $containedItem->removeRequiredInCraft($this);
        }

        return $this;
    }

    public function getRequiredQuestItems(): Collection
    {
        return $this->requiredQuestItems;
    }

    public function setRequiredQuestItems(Collection $questItems): CraftInterface
    {
        $this->requiredQuestItems = $questItems;

        return $this;
    }

    public function addRequiredQuestItem(QuestItemInterface $questItem): CraftInterface
    {
        if (!$this->requiredQuestItems->contains($questItem)) {
            $this->requiredQuestItems->add($questItem);
            $questItem->addRequiredInCraft($this);
        }

        return $this;
    }

    public function removeRequiredQuestItem(QuestItemInterface $questItem): CraftInterface
    {
        if (!$this->requiredQuestItems->contains($questItem)) {
            $this->requiredQuestItems->removeElement($questItem);
            $questItem->removeRequiredInCraft($this);
        }

        return $this;
    }

    public function getRewardContainedItems(): Collection
    {
        return $this->rewardContainedItems;
    }

    public function setRewardContainedItems(Collection $containedItems): CraftInterface
    {
        $this->rewardContainedItems = $containedItems;

        return $this;
    }

    public function addRewardContainedItem(ContainedItemInterface $containedItem): CraftInterface
    {
        if (!$this->rewardContainedItems->contains($containedItem)) {
            $this->rewardContainedItems->add($containedItem);
            $containedItem->addRewardInCraft($this);
        }

        return $this;
    }

    public function removeRewardContainedItem(ContainedItemInterface $containedItem): CraftInterface
    {
        if (!$this->rewardContainedItems->contains($containedItem)) {
            $this->rewardContainedItems->removeElement($containedItem);
            $containedItem->removeRewardInCraft($this);
        }

        return $this;
    }
}
