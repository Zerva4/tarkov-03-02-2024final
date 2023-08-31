<?php

declare(strict_types=1);

namespace App\Entity\Item;

use App\Entity\Quest\QuestKey;
use App\Entity\Trader\TraderCashOffer;
use App\Entity\TranslatableEntity;
use App\Interfaces\Item\ContainedItemInterface;
use App\Interfaces\Item\ItemInterface;
use App\Interfaces\Item\ItemPropertiesInterface;
use App\Interfaces\Item\ItemPropertiesMagazineInterface;
use App\Interfaces\Item\ItemPropertiesWeaponInterface;
use App\Interfaces\Quest\QuestKeyInterface;
use App\Interfaces\Trader\TraderCashOfferInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Item\ItemRepository;
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
#[ORM\Index(columns: ['slug'], name: 'items_slug_idx')]
#[ORM\Index(columns: ['api_id'], name: 'items_api_key_idx')]
#[ORM\Entity(repositoryClass: ItemRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
/**
 * @Vich\Uploadable
 */
class Item extends TranslatableEntity implements UuidPrimaryKeyInterface, ItemInterface, TranslatableInterface
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
    private ?string $typeItem;

    #[ORM\OneToOne(inversedBy: 'item', targetEntity: ItemProperties::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'properties_id', referencedColumnName: 'id', unique: false, onDelete: 'CASCADE')]
    private ?ItemPropertiesInterface $properties = null;

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
     * @var bool Модуль рукоятки
     */
    #[ORM\Column(type: 'boolean', options: ['default' => 0])]
    private bool $hasGrid = false;

    /**
     * @var float|null Масса
     */
    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $weight = null;

    #[ORM\OneToMany(mappedBy: 'item', targetEntity: ContainedItem::class, cascade: ['persist'], fetch: 'EXTRA_LAZY')]
    private Collection $containedItems;

    #[ORM\OneToMany(mappedBy: 'item', targetEntity: TraderCashOffer::class, cascade: ['persist'], fetch: 'EXTRA_LAZY')]
    private Collection $cashOffers;

    #[ORM\OneToMany(mappedBy: 'currencyItem', targetEntity: TraderCashOffer::class, cascade: ['persist'], fetch: 'EXTRA_LAZY')]
    private Collection $currencyCashOffers;

    #[ORM\OneToMany(mappedBy: 'item', targetEntity: QuestKey::class, cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    #[ORM\JoinTable(name: 'quests_keys_items')]
    private ?Collection $questsKeys;

    #[ORM\ManyToMany(targetEntity: ItemPropertiesMagazine::class, mappedBy: 'allowedAmmo', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    private ?Collection $allowedMagazine;

    #[ORM\ManyToMany(targetEntity: ItemPropertiesWeapon::class, mappedBy: 'allowedPresets', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    private ?Collection $presetsWeapons;

    #[ORM\ManyToMany(targetEntity: ItemPropertiesWeapon::class, mappedBy: 'allowedAmmo', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    private ?Collection $allowedWeapons;

//    #[ORM\OneToMany(mappedBy: 'defaultAmmo', targetEntity: ItemPropertiesWeapon::class, cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
//    private Collection $defaultWeapons;
//
//    #[ORM\OneToMany(mappedBy: 'defaultPreset', targetEntity: ItemPropertiesWeapon::class, cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
//    private Collection $defaultPresetWeapons;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        parent::__construct($defaultLocation);

        $this->containedItems = new ArrayCollection();
        $this->cashOffers = new ArrayCollection();
        $this->currencyCashOffers = new ArrayCollection();
        $this->questsKeys = new ArrayCollection();
        $this->allowedMagazine = new ArrayCollection();
        $this->presetsWeapons = new ArrayCollection();
//        $this->defaultWeapons = new ArrayCollection();
//        $this->defaultPresetWeapons = new ArrayCollection();
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
    public function getTypeItem(): ?string
    {
        return $this->typeItem;
    }

    /**
     * @param string $typeItem
     * @return ItemInterface
     */
    public function setTypeItem(string $typeItem): ItemInterface
    {
        $this->typeItem = $typeItem;

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

    public function isHasGrid(): bool
    {
        return $this->hasGrid;
    }

    public function setHasGrid(bool $hasGrid): ItemInterface
    {
        $this->hasGrid = $hasGrid;

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

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): ItemInterface
    {
        $this->imageName = $imageName;

        return $this;
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

    public function getProperties(): ?ItemPropertiesInterface
    {
        return $this->properties;
    }

    public function setProperties(?ItemPropertiesInterface $properties): ItemInterface
    {
        $this->properties = $properties;
        $properties->setItem($this);

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
            $this->containedItems->removeElement($containedItem);
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
            $this->cashOffers->removeElement($cashOffer);
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
            $this->currencyCashOffers->removeElement($cashOffer);
            $cashOffer->setCurrencyItem(null);
        }

        return $this;
    }

    public function getQuestsKeys(): ?Collection
    {
        return $this->questsKeys;
    }

    public function setQuestsKeys(?Collection $questsKeys): ItemInterface
    {
        $this->questsKeys = $questsKeys;

        return $this;
    }

    public function addQuestsKey(QuestKeyInterface $questKey): ItemInterface
    {
        if (!$this->questsKeys->contains($questKey)) {
            $this->questsKeys->add($questKey);
            $questKey->setItem($this);
        }

        return $this;
    }

    public function removeQuestsKey(QuestKeyInterface $questKey): ItemInterface
    {
        if ($this->questsKeys->contains($questKey)) {
            $this->questsKeys->removeElement($questKey);
            $questKey->setItem(null);
        }

        return $this;
    }

    public function getAllowedMagazine(): ?Collection
    {
        return $this->allowedMagazine;
    }

    public function setAllowedMagazine(?Collection $allowedMagazine): ItemInterface
    {
        $this->allowedMagazine = $allowedMagazine;

        return $this;
    }

    public function addAllowedMagazine(ItemPropertiesMagazineInterface $itemPropertiesMagazine): ItemInterface
    {
        if (!$this->allowedMagazine->contains($itemPropertiesMagazine)) {
            $this->allowedMagazine->add($itemPropertiesMagazine);
            $itemPropertiesMagazine->addAllowedAmmo($this);
        }

        return $this;
    }

    public function removeAllowedMagazine(ItemPropertiesMagazineInterface $itemPropertiesMagazine): ItemInterface
    {
        if ($this->allowedMagazine->contains($itemPropertiesMagazine)) {
            $this->allowedMagazine->removeElement($itemPropertiesMagazine);
            $itemPropertiesMagazine->removeAllowedAmmo($this);
        }

        return $this;
    }

    public function getPresetsWeapons(): ?Collection
    {
        return $this->presetsWeapons;
    }

    public function setPresetsWeapons(?Collection $presetsWeapons): ItemInterface
    {
        $this->presetsWeapons = $presetsWeapons;

        return $this;
    }

    public function addPresetsWeapon(ItemPropertiesWeaponInterface $itemPropertiesWeapon): ItemInterface
    {
        if (!$this->presetsWeapons->contains($itemPropertiesWeapon)) {
            $this->presetsWeapons->add($itemPropertiesWeapon);
            $itemPropertiesWeapon->addAllowedPreset($this);
        }

        return $this;
    }

    public function removePresetsWeapon(ItemPropertiesWeaponInterface $itemPropertiesWeapon): ItemInterface
    {
        if ($this->presetsWeapons->contains($itemPropertiesWeapon)) {
            $this->presetsWeapons->removeElement($itemPropertiesWeapon);
            $itemPropertiesWeapon->addAllowedPreset($this);
        }

        return $this;
    }

    public function getAllowedWeapons(): ?Collection
    {
        return $this->allowedWeapons;
    }

    public function setAllowedWeapons(?Collection $allowedWeapons): ItemInterface
    {
        $this->allowedWeapons = $allowedWeapons;

        return $this;
    }

    public function addAllowedWeapon(ItemPropertiesWeaponInterface $itemPropertiesWeapon): ItemInterface
    {
        if (!$this->allowedWeapons->contains($itemPropertiesWeapon)) {
            $this->allowedWeapons->add($itemPropertiesWeapon);
            $itemPropertiesWeapon->addAllowedAmmo($this);
        }

        return $this;
    }

    public function removeAllowedWeapon(ItemPropertiesWeaponInterface $itemPropertiesWeapon): ItemInterface
    {
        if ($this->allowedWeapons->contains($itemPropertiesWeapon)) {
            $this->allowedWeapons->removeElement($itemPropertiesWeapon);
            $itemPropertiesWeapon->removeAllowedAmmo($this);
        }

        return $this;
    }

//    public function getDefaultWeapons(): Collection
//    {
//        return $this->defaultWeapons;
//    }

//    public function setDefaultWeapons(Collection $defaultWeapons): ItemInterface
//    {
//        $this->defaultWeapons = $defaultWeapons;
//
//        return $this;
//    }

//    public function addDefaultWeapon(ItemPropertiesWeaponInterface $itemPropertiesWeapon): ItemInterface
//    {
//        if (!$this->defaultWeapons->contains($itemPropertiesWeapon)) {
//            $this->defaultWeapons->add($itemPropertiesWeapon);
//            $itemPropertiesWeapon->setDefaultAmmo($this);
//        }
//
//        return $this;
//    }
//
//    public function removeDefaultWeapon(ItemPropertiesWeaponInterface $itemPropertiesWeapon): ItemInterface
//    {
//        if ($this->defaultWeapons->contains($itemPropertiesWeapon)) {
//            $this->defaultWeapons->removeElement($itemPropertiesWeapon);
//            $itemPropertiesWeapon->setDefaultAmmo(null);
//        }
//
//        return $this;
//    }

//    public function getDefaultPresetWeapons(): Collection
//    {
//        return $this->defaultPresetWeapons;
//    }
//
//    public function setDefaultPresetWeapons(Collection $defaultPresetWeapons): ItemInterface
//    {
//        $this->defaultPresetWeapons = $defaultPresetWeapons;
//
//        return $this;
//    }
//
//    public function addDefaultPresetWeapon(ItemPropertiesWeaponInterface $itemPropertiesWeapon): ItemInterface
//    {
//        if (!$this->defaultPresetWeapons->contains($itemPropertiesWeapon)) {
//            $this->defaultPresetWeapons->add($itemPropertiesWeapon);
//            $itemPropertiesWeapon->setDefaultPreset($this);
//        }
//
//        return $this;
//    }
//
//    public function removeDefaultPresetWeapon(ItemPropertiesWeaponInterface $itemPropertiesWeapon): ItemInterface
//    {
//        if ($this->defaultPresetWeapons->contains($itemPropertiesWeapon)) {
//            $this->defaultPresetWeapons->removeElement($itemPropertiesWeapon);
//            $itemPropertiesWeapon->setDefaultPreset(null);
//        }
//
//        return $this;
//    }

    public function __toString(): string
    {
        return $this->__get('name');
    }
}
