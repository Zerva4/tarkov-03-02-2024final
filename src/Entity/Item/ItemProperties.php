<?php

declare(strict_types=1);

namespace App\Entity\Item;

use App\Interfaces\Item\ItemMaterialInterface;
use App\Interfaces\Item\ItemInterface;
use App\Interfaces\Item\ItemPropertiesInterface;
use App\Interfaces\Item\ItemStorageGridInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Item\ItemPropertiesRepository;
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
    'ItemPropertiesPainkiller' => ItemPropertiesPainkiller::class,
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
    #[ORM\JoinColumn(name: 'item_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private ItemInterface $item;

    #[ORM\ManyToOne(targetEntity: ItemMaterial::class, fetch: 'EAGER', inversedBy: 'properties')]
    #[ORM\JoinColumn(referencedColumnName: 'id', onDelete: 'cascade')]
    private ?ItemMaterialInterface $material = null;

    #[ORM\ManyToOne(targetEntity: ItemStorageGrid::class, fetch: 'EAGER', inversedBy: 'properties')]
    #[ORM\JoinColumn(referencedColumnName: 'id', onDelete: 'cascade')]
    private ?ItemStorageGridInterface $grids = null;

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
}
