<?php

declare(strict_types=1);

namespace App\Entity\Item\Properties;

use App\Entity\Item\Item;
use App\Entity\Item\ItemCaliber;
use App\Entity\Item\ItemMaterial;
use App\Entity\Item\ItemStorageGrid;
use App\Interfaces\Item\ItemCaliberInterface;
use App\Interfaces\Item\ItemInterface;
use App\Interfaces\Item\ItemMaterialInterface;
use App\Interfaces\Item\ItemStorageGridInterface;
use App\Interfaces\Item\Properties\ItemPropertiesInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Item\Properties\ItemPropertiesRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties')]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'type_property', type: 'string', length: 50)]
#[ORM\DiscriminatorMap([
    'ItemPropertiesAmmo' => ItemPropertiesAmmo::class,
    'ItemPropertiesArmor' => ItemPropertiesArmor::class,
    'ItemPropertiesBackpack' => ItemPropertiesBackpack::class,
    'ItemPropertiesChestRig' => ItemPropertiesChestRig::class,
    'ItemPropertiesContainer' => ItemPropertiesContainer::class,
    'ItemPropertiesFoodDrink' => ItemPropertiesFoodDrink::class,
    'ItemPropertiesGlasses' => ItemPropertiesGlasses::class,
    'ItemPropertiesBarrel' => ItemPropertiesBarrel::class,
    'ItemPropertiesGrenade' => ItemPropertiesGrenade::class,
    'ItemPropertiesHeadphone' => ItemPropertiesHeadphone::class,
    'ItemPropertiesHelmet' => ItemPropertiesHelmet::class,
    'ItemPropertiesKey' => ItemPropertiesKey::class,
    'ItemPropertiesMagazine' => ItemPropertiesMagazine::class,
    'ItemPropertiesMedicalItem' => ItemPropertiesMedicalItem::class,
    'ItemPropertiesMedKit' => ItemPropertiesMedKit::class,
    'ItemPropertiesMelee' => ItemPropertiesMelee::class,
    'ItemPropertiesNightVision' => ItemPropertiesNightVision::class,
    'ItemPropertiesPreset' => ItemPropertiesPreset::class,
    'ItemPropertiesPainkiller' => ItemPropertiesPainkiller::class,
    'ItemPropertiesStimulation' => ItemPropertiesStimulation::class,
    'ItemPropertiesScope' => ItemPropertiesScope::class,
    'ItemPropertiesSurgicalKit' => ItemPropertiesSurgicalKit::class,
    'ItemPropertiesWeapon' => ItemPropertiesWeapon::class,
    'ItemPropertiesWeaponMod' => ItemPropertiesWeaponMod::class
])]
#[ORM\Entity(repositoryClass: ItemPropertiesRepository::class)]
class ItemProperties implements ItemPropertiesInterface, UuidPrimaryKeyInterface
{
    use UuidPrimaryKeyTrait;

    #[ORM\OneToOne(mappedBy: 'properties', targetEntity: Item::class)]
    #[ORM\JoinColumn(name: 'item_id', referencedColumnName: 'id', unique: false)]
    private ItemInterface $item;

    #[ORM\ManyToOne(targetEntity: ItemMaterial::class, fetch: 'EAGER', inversedBy: 'properties')]
    #[ORM\JoinColumn(referencedColumnName: 'id', onDelete: 'SET NULL')]
    private ?ItemMaterialInterface $material = null;

    #[ORM\ManyToOne(targetEntity: ItemStorageGrid::class, fetch: 'EAGER', inversedBy: 'properties')]
    #[ORM\JoinColumn(referencedColumnName: 'id', onDelete: 'CASCADE')]
    private ?ItemStorageGridInterface $grids = null;

    #[ORM\ManyToOne(targetEntity: ItemCaliber::class, fetch: 'EAGER', inversedBy: 'properties')]
    #[ORM\JoinColumn(referencedColumnName: 'id', onDelete: 'SET NULL')]
    private ?ItemCaliberInterface $caliber = null;

    public function getItem(): ItemInterface
    {
        return $this->item;
    }

    public function setItem(ItemInterface $item): ItemPropertiesInterface
    {
        $this->item = $item;

        return $this;
    }

    public function getMaterial(): ?ItemMaterialInterface
    {
        return $this->material;
    }

    public function setMaterial(?ItemMaterialInterface $material): ItemPropertiesInterface
    {
        $this->material = $material;
        if ($material instanceof ItemMaterialInterface) $material->addProperties($this);

        return $this;
    }

    public function getGrids(): ?ItemStorageGridInterface
    {
        return $this->grids;
    }

    public function setGrids(?ItemStorageGridInterface $grids): ItemPropertiesInterface
    {
        $this->grids = $grids;

        return $this;
    }

    public function getCaliber(): ?ItemCaliberInterface
    {
        return $this->caliber;
    }

    public function setCaliber(?ItemCaliberInterface $caliber): ItemPropertiesInterface
    {
        $this->caliber = $caliber;
        if ($caliber instanceof ItemCaliberInterface) $caliber->addProperties($this);

        return $this;
    }
}
