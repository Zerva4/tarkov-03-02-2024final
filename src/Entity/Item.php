<?php

namespace App\Entity;

use App\Interfaces\QuestInterface;
use App\Repository\ItemRepository;
use App\Traits\SlugTrait;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Interfaces\ItemInterface;

#[ORM\Table(name: 'items')]
#[ORM\Index(columns: ['slug'], name: 'items_slug_idx')]
#[ORM\Index(columns: ['api_id'], name: 'items_api_key_idx')]
#[ORM\Entity(repositoryClass: ItemRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Item extends BaseEntity implements ItemInterface
{
    use UuidPrimaryKeyTrait;
    use SlugTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $apiId;

    #[ORM\Column(type: 'boolean')]
    private bool $published;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $slug;

    #[ORM\Column(type: 'json', nullable: true)]
    private array $types = [];

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $basePrice = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $width = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $height = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $backgroundColor = null;

    /**
     * @var float|null Модификатор точности
     */
    #[ORM\Column(type: 'float', length: 255, nullable: true)]
    private ?float $accuracyModifier = null;

    /**
     * @var float|null Модификатор отдачи
     */
    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $recoilModifier = null;

    /**
     * @var float|null Модификатор эргономики
     */
    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $ergonomicsModifier = null;

    /**
     * @var bool Модуль рукоятки
     */
    #[ORM\Column(type: 'boolean', options: ['default' => 0])]
    private bool $hasGrid = false;

    /**
     * @var bool Использует наушники
     */
    #[ORM\Column(type: 'boolean', options: ['default' => 0])]
    private bool $blocksHeadphones = false;

    /**
     * @var float|null Масса
     */
    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $weight = null;

    /**
     * @var float|null Скорость
     */
    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $velocity = null;

    /**
     * @var int|null
     */
    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $loudness = null;

    /**
     * @var ArrayCollection|Collection|null
     */
    #[ORM\ManyToMany(targetEntity: Quest::class, mappedBy: 'usedItems', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    #[ORM\JoinTable(name: 'quests_used_items')]
    private Collection|ArrayCollection|null $usedInQuests;

    /**
     * @var ArrayCollection|Collection|null
     */
    #[ORM\ManyToMany(targetEntity: Quest::class, mappedBy: 'receivedItems', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    #[ORM\JoinTable(name: 'quests_received_items')]
    private Collection|ArrayCollection|null $receivedFromQuests;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        parent::__construct($defaultLocation);

        $this->usedInQuests = new ArrayCollection();
        $this->receivedFromQuests = new ArrayCollection();
        $this->bartersFor = new ArrayCollection();
    }

    public function getApiId(): string
    {
        return $this->apiId;
    }

    public function setApiId(string $apiId): ItemInterface
    {
        $this->apiId = $apiId;

        return $this;
    }

    public function isPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): ItemInterface
    {
        $this->published = $published;

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): ItemInterface
    {
        $this->slug = $slug;

        return $this;
    }

    public function getTypes(): array
    {
        return $this->types;
    }

    public function setTypes(array $types): ItemInterface
    {
        $this->types = $types;

        return $this;
    }

    public function getBasePrice(): ?int
    {
        return $this->basePrice;
    }

    public function setBasePrice(?int $basePrice): ItemInterface
    {
        $this->basePrice = $basePrice;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): ItemInterface
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): ItemInterface
    {
        $this->height = $height;

        return $this;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->backgroundColor;
    }

    public function setBackgroundColor(?string $backgroundColor): ItemInterface
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    public function getAccuracyModifier(): ?float
    {
        return $this->accuracyModifier;
    }

    public function setAccuracyModifier(?float $accuracyModifier): ItemInterface
    {
        $this->accuracyModifier = $accuracyModifier;

        return $this;
    }

    public function getRecoilModifier(): ?float
    {
        return $this->recoilModifier;
    }

    public function setRecoilModifier(?float $recoilModifier): ItemInterface
    {
        $this->recoilModifier = $recoilModifier;

        return $this;
    }

    public function getErgonomicsModifier(): ?float
    {
        return $this->ergonomicsModifier;
    }

    public function setErgonomicsModifier(?float $ergonomicsModifier): ItemInterface
    {
        $this->ergonomicsModifier = $ergonomicsModifier;

        return $this;
    }

    public function isHasGrid(): bool
    {
        return $this->hasGrid;
    }

    public function setHasGrid(bool $hasGrid): ItemInterface
    {
        $this->hasGrid = $hasGrid;

        return $this;
    }

    public function isBlocksHeadphones(): bool
    {
        return $this->blocksHeadphones;
    }

    public function setBlocksHeadphones(bool $blocksHeadphones): ItemInterface
    {
        $this->blocksHeadphones = $blocksHeadphones;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): ItemInterface
    {
        $this->weight = $weight;

        return $this;
    }

    public function getVelocity(): ?float
    {
        return $this->velocity;
    }

    public function setVelocity(?float $velocity): ItemInterface
    {
        $this->velocity = $velocity;

        return $this;
    }

    public function getLoudness(): ?int
    {
        return $this->loudness;
    }

    public function setLoudness(?int $loudness): ItemInterface
    {
        $this->loudness = $loudness;

        return $this;
    }

    public function getUsedInQuests(): ?Collection
    {
        return $this->usedInQuests;
    }

    public function setUsedInQuests(?Collection $usedInQuests): ItemInterface
    {
        $this->usedInQuests = $usedInQuests;

        return $this;
    }

    public function addUsedInQuest(QuestInterface $quest): ItemInterface
    {
        if (!$this->usedInQuests->contains($quest)) {
            $this->usedInQuests->add($quest);
            $quest->addUsedItem($this);
        }

        return $this;
    }

    public function removeUsedInQuest(QuestInterface $quest): ItemInterface
    {
        if ($this->usedInQuests->contains($quest)) {
            $this->usedInQuests->removeElement($quest);
            $quest->removeUsedItem($this);
        }

        return $this;
    }

    public function getReceivedFromQuests(): ?Collection
    {
        return $this->receivedFromQuests;
    }

    public function setReceivedFromQuests(?Collection $receivedFromQuests): ItemInterface
    {
        $this->receivedFromQuests = $receivedFromQuests;

        return $this;
    }

    public function addReceivedFromQuest(QuestInterface $quest): ItemInterface
    {
        if (!$this->receivedFromQuests->contains($quest)) {
            $this->receivedFromQuests->add($quest);
            $quest->addReceivedItem($this);
        }

        return $this;
    }

    public function removeReceivedFromQuest(QuestInterface $quest): ItemInterface
    {
        if ($this->receivedFromQuests->contains($quest)) {
            $this->receivedFromQuests->removeElement($quest);
            $quest->removeReceivedItem($this);
        }

        return $this;
    }
}
