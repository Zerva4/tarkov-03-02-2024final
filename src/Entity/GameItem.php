<?php

namespace App\Entity;

use App\Repository\GameItemRepository;
use App\Traits\SlugTrait;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Interfaces\GameItemInterface;

#[ORM\Table(name: 'items')]
#[ORM\Index(columns: ['slug'], name: 'item_slug_idx')]
#[ORM\Index(columns: ['api_id'], name: 'item_api_key_idx')]
#[ORM\Entity(repositoryClass: GameItemRepository::class)]
class GameItem extends BaseEntity implements GameItemInterface
{
    use UuidPrimaryKeyTrait;
    use SlugTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $apiId;

    #[ORM\Column(type: 'boolean')]
    private bool $published;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $slug;

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
     * @var ArrayCollection|Collection|null
     */
    #[ORM\ManyToMany(targetEntity: Quest::class, mappedBy: 'usedGameItems', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    private Collection|ArrayCollection|null $usedInTasks;

    /**
     * @var ArrayCollection|Collection|null
     */
    #[ORM\ManyToMany(targetEntity: Quest::class, mappedBy: 'receivedGameItems', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    private Collection|ArrayCollection|null $receivedFromTasks;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        parent::__construct($defaultLocation);

        $this->usedInTasks = new ArrayCollection();
        $this->receivedFromTasks = new ArrayCollection();
    }

    public function getApiId(): string
    {
        return $this->apiId;
    }

    public function setApiId(string $apiId): GameItemInterface
    {
        $this->apiId = $apiId;

        return $this;
    }

    public function isPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): GameItemInterface
    {
        $this->published = $published;

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): GameItemInterface
    {
        $this->slug = $slug;

        return $this;
    }

    public function getBasePrice(): ?int
    {
        return $this->basePrice;
    }

    public function setBasePrice(?int $basePrice): GameItemInterface
    {
        $this->basePrice = $basePrice;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): GameItemInterface
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): GameItemInterface
    {
        $this->height = $height;

        return $this;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->backgroundColor;
    }

    public function setBackgroundColor(?string $backgroundColor): GameItemInterface
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    public function getAccuracyModifier(): ?float
    {
        return $this->accuracyModifier;
    }

    public function setAccuracyModifier(?float $accuracyModifier): GameItemInterface
    {
        $this->accuracyModifier = $accuracyModifier;

        return $this;
    }

    public function getRecoilModifier(): ?float
    {
        return $this->recoilModifier;
    }

    public function setRecoilModifier(?float $recoilModifier): GameItemInterface
    {
        $this->recoilModifier = $recoilModifier;

        return $this;
    }

    public function getErgonomicsModifier(): ?float
    {
        return $this->ergonomicsModifier;
    }

    public function setErgonomicsModifier(?float $ergonomicsModifier): GameItemInterface
    {
        $this->ergonomicsModifier = $ergonomicsModifier;

        return $this;
    }

    public function isHasGrid(): bool
    {
        return $this->hasGrid;
    }

    public function setHasGrid(bool $hasGrid): GameItemInterface
    {
        $this->hasGrid = $hasGrid;

        return $this;
    }

    public function isBlocksHeadphones(): bool
    {
        return $this->blocksHeadphones;
    }

    public function setBlocksHeadphones(bool $blocksHeadphones): GameItemInterface
    {
        $this->blocksHeadphones = $blocksHeadphones;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): GameItemInterface
    {
        $this->weight = $weight;

        return $this;
    }

    public function getVelocity(): ?float
    {
        return $this->velocity;
    }

    public function setVelocity(?float $velocity): GameItemInterface
    {
        $this->velocity = $velocity;

        return $this;
    }

    public function getUsedInTasks(): ?Collection
    {
        return $this->usedInTasks;
    }

    public function setUsedInTasks(?Collection $usedInTasks): GameItemInterface
    {
        $this->usedInTasks = $usedInTasks;

        return $this;
    }

    public function getReceivedInTasks(): ?Collection
    {
        return $this->receivedFromTasks;
    }

    public function setReceivedInTasks(?Collection $receivedInTasks): GameItemInterface
    {
        $this->receivedFromTasks = $receivedInTasks;

        return $this;
    }
}
