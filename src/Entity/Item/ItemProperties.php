<?php

namespace App\Entity\Item;

use App\Interfaces\Item\ArmorMaterialInterface;
use App\Interfaces\Item\ItemInterface;
use App\Interfaces\Item\ItemPropertiesInterface;
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
])]
#[ORM\Entity(repositoryClass: ItemPropertiesRepository::class)]
class ItemProperties implements ItemPropertiesInterface, UuidPrimaryKeyInterface
{
    use UuidPrimaryKeyTrait;

    #[ORM\OneToOne(mappedBy: 'properties', targetEntity: Item::class)]
    #[ORM\JoinColumn(name: 'item_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private ItemInterface $item;

    #[ORM\ManyToOne(targetEntity: ArmorMaterial::class, fetch: 'EAGER', inversedBy: 'properties')]
    #[ORM\JoinColumn(referencedColumnName: 'id', onDelete: 'cascade')]
    private ?ArmorMaterialInterface $material = null;

    public function getItem(): ItemInterface
    {
        return $this->item;
    }

    public function setItem(ItemInterface $item): ItemPropertiesInterface
    {
        $this->item = $item;

        return $this;
    }

    public function getMaterial(): ?ArmorMaterialInterface
    {
        return $this->material;
    }

    public function setMaterial(?ArmorMaterialInterface $material): ItemPropertiesInterface
    {
        $this->material = $material;

        return $this;
    }
}
