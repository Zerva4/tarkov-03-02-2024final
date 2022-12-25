<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Items\Item;
use App\Interfaces\ItemInterface;
use App\Interfaces\MapInterface;
use App\Interfaces\QuestInterface;
use App\Interfaces\QuestObjectiveInterface;
use App\Interfaces\TraderInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\QuestRepository;
use App\Traits\SlugTrait;
use App\Traits\UuidPrimaryKeyTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Table(name: 'quests')]
#[ORM\Index(columns: ['slug'], name: 'quests_slug_idx')]
#[ORM\Index(columns: ['api_id'], name: 'quests_api_key_idx')]
#[ORM\Entity(repositoryClass: QuestRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
/**
 * @Vich\Uploadable
 */
class Quest extends TranslatableEntity implements UuidPrimaryKeyInterface, QuestInterface, TranslatableInterface
{
    use UuidPrimaryKeyTrait;
    use SlugTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $apiId;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0])]
    private int $position = 0;

    #[ORM\Column(type: 'boolean')]
    private bool $published;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $imageName = null;

    #[Vich\UploadableField(mapping: 'quests', fileNameProperty: 'imageName')]
    #[Assert\Valid]
    #[Assert\File(
        maxSize: '2M',
        mimeTypes: ['image/jpg', 'image/gif', 'image/jpeg', 'image/png']
    )]
    /**
     * @Vich\UploadableField(mapping="quests", fileNameProperty="imageName")
     * @Assert\Valid
     * @Assert\File(
     *     maxSize="2M",
     *     mimeTypes={
     *         "image/jpg", "image/gif", "image/jpeg", "image/png"
     *     }
     * )
     */
    private ?File $imageFile = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $experience = null;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $minPlayerLevel = 1;

    #[ORM\ManyToOne(targetEntity: Trader::class, cascade: ['persist'], inversedBy: 'quests')]
    #[ORM\JoinColumn(referencedColumnName: 'id', onDelete: 'SET NULL')]
    private ?TraderInterface $trader = null;

    #[ORM\ManyToOne(targetEntity: Map::class, inversedBy: 'quests')]
    #[ORM\JoinColumn(referencedColumnName: 'id', onDelete: 'SET NULL')]
    private ?MapInterface $map = null;

    #[ORM\OneToMany(mappedBy: 'quest', targetEntity: QuestObjective::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    private Collection $objectives;

    #[ORM\ManyToMany(targetEntity: Item::class, inversedBy: 'usedInQuests', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    #[ORM\JoinTable(name: 'quests_used_items')]
    private ?Collection $usedItems;

    #[ORM\ManyToMany(targetEntity: Item::class, inversedBy: 'receivedFromQuests', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    #[ORM\JoinTable(name: 'quests_received_items')]
    private ?Collection $receivedItems;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        parent::__construct($defaultLocation);

        $this->objectives = new ArrayCollection();
        $this->usedItems = new ArrayCollection();
        $this->receivedItems = new ArrayCollection();
    }

    public function getApiId(): string
    {
        return $this->apiId;
    }

    public function setApiId(string $apiId): QuestInterface
    {
        $this->apiId = $apiId;

        return $this;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): QuestInterface
    {
        $this->position = $position;

        return $this;
    }

    public function isPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): QuestInterface
    {
        $this->published = $published;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): QuestInterface
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getTrader(): ?TraderInterface
    {
        return $this->trader;
    }

    public function setTrader(?TraderInterface $trader): QuestInterface
    {
        $this->trader = $trader;

        return $this;
    }

    public function getMap(): ?MapInterface
    {
        return $this->map;
    }

    public function setMap(?MapInterface $map): QuestInterface
    {
        $this->map = $map;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile): QuestInterface
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            $this->updatedAt = new DateTime('NOW');
        }

        return $this;
    }

    public function getObjectives(): Collection
    {
        return $this->objectives;
    }

    public function setObjectives(Collection $objectives): QuestInterface
    {
        $this->objectives = $objectives;

        return $this;
    }

    public function addObjective(QuestObjectiveInterface ...$objectives): QuestInterface
    {
        foreach ($objectives as $objective) {
            if (!$this->objectives->contains($objective)) {
                $this->objectives->add($objective);
                $objective->setQuest($this);
            }
        }

        return $this;
    }

    public function removeObjective(QuestObjectiveInterface $objective): QuestInterface
    {
        if ($this->objectives->contains($objective)) {
            $this->objectives->removeElement($objective);
            $objective->setQuest(null);
        }

        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(?int $experience): QuestInterface
    {
        $this->experience = $experience;

        return $this;
    }

    public function getMinPlayerLevel(): int
    {
        return $this->minPlayerLevel;
    }

    public function setMinPlayerLevel(int $minPlayerLevel): QuestInterface
    {
        $this->minPlayerLevel = $minPlayerLevel;

        return $this;
    }

    public function getUsedItems(): ?Collection
    {
        return $this->usedItems;
    }

    public function setUsedItems(?Collection $usedItems): QuestInterface
    {
        $this->usedItems = $usedItems;

        return $this;
    }

    public function addUsedItem(ItemInterface $item): QuestInterface
    {
        if (!$this->usedItems->contains($item)) {
            $this->usedItems->add($item);
            $item->addUsedInQuest($this);
        }

        return $this;
    }

    public function removeUsedItem(ItemInterface $item): QuestInterface
    {
        if ($this->usedItems->contains($item)) {
            $this->usedItems->removeElement($item);
            $item->removeUsedInQuest($this);
        }

        return $this;
    }

    public function getReceivedItems(): ?Collection
    {
        return $this->receivedItems;
    }

    public function setReceivedItems(?Collection $receivedItems): QuestInterface
    {
        $this->receivedItems = $receivedItems;

        return $this;
    }

    public function addReceivedItem(ItemInterface $item): QuestInterface
    {
        if (!$this->receivedItems->contains($item)) {
            $this->receivedItems->add($item);
            $item->addReceivedFromQuest($this);
        }

        return $this;
    }

    public function removeReceivedItem(ItemInterface $item): QuestInterface
    {
        if ($this->receivedItems->contains($item)) {
            $this->receivedItems->removeElement($item);
            $item->removeReceivedFromQuest($this);
        }

        return $this;
    }
}
