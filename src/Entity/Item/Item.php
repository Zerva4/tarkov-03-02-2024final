<?php

namespace App\Entity\Item;

use App\Entity\Quest\Quest;
use App\Entity\Trader\TraderCashOffer;
use App\Entity\TranslatableEntity;
use App\Interfaces\Item\ContainedItemInterface;
use App\Interfaces\Item\ItemInterface;
use App\Interfaces\Quest\QuestInterface;
use App\Interfaces\Trader\TraderCashOfferInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Item\ItemRepository;
use App\Traits\SlugTrait;
use App\Traits\UuidPrimaryKeyTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/** "ItemPropertiesWeapon" => 1
  "none" => 1
  "ItemPropertiesKey" => 1
  "ItemPropertiesGrenade" => 1
  "ItemPropertiesMagazine" => 1
  "ItemPropertiesFoodDrink" => 1
  "ItemPropertiesWeaponMod" => 1
  "ItemPropertiesMelee" => 1
  "ItemPropertiesContainer" => 1
  "ItemPropertiesScope" => 1
  "ItemPropertiesChestRig" => 1
  "ItemPropertiesBackpack" => 1
  "ItemPropertiesMedicalItem" => 1
  "ItemPropertiesPainkiller" => 1
  "ItemPropertiesMedKit" => 1
  "ItemPropertiesAmmo" => 1
  "ItemPropertiesArmor" => 1
  "ItemPropertiesGlasses" => 1
  "ItemPropertiesBarrel" => 1
  "ItemPropertiesHelmet" => 1
  "ItemPropertiesNightVision" => 1
  "ItemPropertiesPreset" => 1
  "ItemPropertiesArmorAttachment" => 1
  "ItemPropertiesStim" => 1
  "ItemPropertiesSurgicalKit" => 1
**/

#[ORM\Table(name: 'items')]
//#[ORM\InheritanceType('JOINED')]
//#[ORM\DiscriminatorColumn(name: 'type', type: 'string', length: 50)]
//#[ORM\DiscriminatorMap([
//    'ItemPropertiesWeapon' => ItemPropertiesWeapon::class
//])]
#[ORM\Index(columns: ['slug'], name: 'items_slug_idx')]
#[ORM\Index(columns: ['api_id'], name: 'items_api_key_idx')]
#[ORM\Entity(repositoryClass: ItemRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
/**
 * @Vich\Uploadable
 */
class Item extends TranslatableEntity implements UuidPrimaryKeyInterface, ItemInterface
{
    use UuidPrimaryKeyTrait;
    use SlugTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $apiId;

    #[ORM\Column(type: 'boolean')]
    private bool $published;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $imageName = null;

    #[Vich\UploadableField(mapping: 'items', fileNameProperty: 'imageName')]
    #[Assert\Valid]
    #[Assert\File(
        maxSize: '2M',
        mimeTypes: ['image/jpg', 'image/gif', 'image/jpeg', 'image/png']
    )]
    /**
     * @Vich\UploadableField(mapping="items", fileNameProperty="imageName")
     * @Assert\Valid
     * @Assert\File(
     *     maxSize="2M",
     *     mimeTypes={
     *         "image/jpg", "image/gif", "image/jpeg", "image/png"
     *     }
     * )
     */
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $slug;

    #[ORM\Column(type: 'json', nullable: true, options: ["jsonb" => true])]
    private ?array $types = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $typeProperties;

    #[ORM\Column(type: 'json', nullable: true, options: ["jsonb" => true])]
    private ?array $properties = null;

    /**
     * @var int|null Базовая цена
     */
    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $basePrice = null;

    /**
     * @var int|null Ширина
     */
    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $width = null;

    /**
     * @var int|null Высота
     */
    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $height = null;

    /**
     * @var string|null Цвет фона
     */
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
     * @var int|null Громкость
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

    #[ORM\OneToMany(mappedBy: 'item', targetEntity: ContainedItem::class, cascade: ['persist'], fetch: 'EXTRA_LAZY')]
    private Collection $containedItems;

    #[ORM\OneToMany(mappedBy: 'item', targetEntity: TraderCashOffer::class, cascade: ['persist'], fetch: 'EXTRA_LAZY')]
    private Collection $cashOffers;

    #[ORM\OneToMany(mappedBy: 'currencyItem', targetEntity: TraderCashOffer::class, cascade: ['persist'], fetch: 'EXTRA_LAZY')]
    private Collection $currencyCashOffers;

    #[ORM\ManyToMany(targetEntity: Quest::class, mappedBy: 'neededKeys', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    #[ORM\JoinTable(name: 'quests_needed_keys')]
    private ?Collection $neededInQuests;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        parent::__construct($defaultLocation);

        $this->usedInQuests = new ArrayCollection();
        $this->receivedFromQuests = new ArrayCollection();
        $this->containedItems = new ArrayCollection();
        $this->cashOffers = new ArrayCollection();
        $this->currencyCashOffers = new ArrayCollection();
        $this->neededInQuests = new ArrayCollection();
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

    /**
     * @return string|null
     */
    public function getTypeProperties(): ?string
    {
        return $this->typeProperties;
    }

    /**
     * @param string $typeProperties
     * @return ItemInterface
     */
    public function setTypeProperties(string $typeProperties): ItemInterface
    {
        $this->typeProperties = $typeProperties;

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

    /**
     * @return string|null
     */
    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @param string|null $imageName
     */
    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile): ItemInterface
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            $this->updatedAt = new DateTime('NOW');
        }

        return $this;
    }

    /**
     * @return array|null
     */
    public function getProperties(): ?array
    {
        return $this->properties;
    }

    /**
     * @param array|null $properties
     * @return ItemInterface
     */
    public function setProperties(?array $properties): ItemInterface
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getContainedItems(): Collection
    {
        return $this->containedItems;
    }

    /**
     * @param Collection $containedItems
     * @return ItemInterface
     */
    public function setContainedItems(Collection $containedItems): ItemInterface
    {
        $this->containedItems = $containedItems;

        return $this;
    }

    public function addContainedItem(ContainedItemInterface $containedItem): ItemInterface
    {
        if (!$this->containedItems->contains($containedItem)) {
            $this->containedItems->add($containedItem);
            $containedItem->setItem($this);
        }

        return $this;
    }

    public function removeContainedItem(ContainedItemInterface $containedItem): ItemInterface
    {
        if ($this->containedItems->contains($containedItem)) {
            $this->containedItems->add($containedItem);
            $containedItem->setItem(null);
        }

        return $this;
    }

    public function getCashOffers(): Collection
    {
        return $this->cashOffers;
    }

    public function setCashOffers(Collection $cashOffers): ItemInterface
    {
        $this->cashOffers = $cashOffers;

        return $this;
    }

    public function addCashOffer(TraderCashOfferInterface $cashOffer): ItemInterface
    {
        if (!$this->cashOffers->contains($cashOffer)) {
            $this->cashOffers->add($cashOffer);
            $cashOffer->setItem($this);
        }

        return $this;
    }

    public function removeCashOffer(TraderCashOfferInterface $cashOffer): ItemInterface
    {
        if ($this->cashOffers->contains($cashOffer)) {
            $this->cashOffers->add($cashOffer);
            $cashOffer->setItem(null);
        }

        return $this;
    }

    public function getCurrencyCashOffers(): Collection
    {
        return $this->currencyCashOffers;
    }

    public function setCurrencyCashOffers(Collection $currencyCashOffers): ItemInterface
    {
        $this->currencyCashOffers = $currencyCashOffers;

        return $this;
    }

    public function addCurrencyCashOffer(TraderCashOfferInterface $cashOffer): ItemInterface
    {
        if (!$this->cashOffers->contains($cashOffer)) {
            $this->cashOffers->add($cashOffer);
            $cashOffer->setCurrencyItem($this);
        }

        return $this;
    }

    public function removeCurrencyCashOffer(TraderCashOfferInterface $cashOffer): ItemInterface
    {
        if ($this->currencyCashOffers->contains($cashOffer)) {
            $this->currencyCashOffers->add($cashOffer);
            $cashOffer->setCurrencyItem(null);
        }

        return $this;
    }

    public function getNeededInQuests(): ?Collection
    {
        return $this->neededInQuests;
    }

    public function setNeededInQuests(?Collection $neededInQuests): ItemInterface
    {
        $this->neededInQuests = $neededInQuests;

        return $this;
    }

    public function addNeededInQuest(QuestInterface $quest): ItemInterface
    {
        if (!$this->neededInQuests->contains($quest)) {
            $this->neededInQuests->add($quest);
            $quest->addNeededKey($this);
        }

        return $this;
    }

    public function removeNeededInQuest(QuestInterface $quest): ItemInterface
    {
        if ($this->neededInQuests->contains($quest)) {
            $this->neededInQuests->removeElement($quest);
            $quest->removeNeededKey($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->__get('title');
    }
}
