<?php

declare(strict_types=1);

namespace App\Entity\Item;

use App\Interfaces\Item\ItemInterface;
use App\Interfaces\Item\ItemPropertiesInterface;
use App\Interfaces\Item\ItemPropertiesMagazineInterface;
use App\Repository\Item\ItemPropertiesMagazineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_magazine', options: ['comment' => 'Таблица свойств для магазина патронов'])]
#[ORM\Entity(repositoryClass: ItemPropertiesMagazineRepository::class)]
class ItemPropertiesMagazine  extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesMagazineInterface
{
    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Эргономика'])]
    private float $ergonomics;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Отдача в процентах'])]
    private float $recoilModifier;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Вместимость'])]
    private int $capacity;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Модификатор загрузки'])]
    private float $loadModifier;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Модификатор проверки боеприпасов'])]
    private float $ammoCheckModifier;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Шанс неисправности'])]
    private float $malfunctionChance;

    #[ORM\ManyToMany(targetEntity: Item::class, inversedBy: 'allowedMagazine', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    #[ORM\JoinTable(name: 'items_properties_magazine_ammo')]
    private ?Collection $allowedAmmo;

    public function __construct()
    {
        $this->allowedAmmo = new ArrayCollection();
    }

    public function getErgonomics(): float
    {
        return $this->ergonomics;
    }

    public function setErgonomics(float $ergonomics): ItemPropertiesMagazineInterface
    {
        $this->ergonomics = $ergonomics;

        return $this;
    }

    public function getRecoilModifier(): float
    {
        return $this->recoilModifier;
    }

    public function setRecoilModifier(float $recoilModifier): ItemPropertiesMagazineInterface
    {
        $this->recoilModifier = $recoilModifier;

        return $this;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): ItemPropertiesMagazineInterface
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getLoadModifier(): float
    {
        return $this->loadModifier;
    }

    public function setLoadModifier(float $loadModifier): ItemPropertiesMagazineInterface
    {
        $this->loadModifier = $loadModifier;

        return $this;
    }

    public function getAmmoCheckModifier(): float
    {
        return $this->ammoCheckModifier;
    }

    public function setAmmoCheckModifier(float $ammoCheckModifier): ItemPropertiesMagazineInterface
    {
        $this->ammoCheckModifier = $ammoCheckModifier;

        return $this;
    }

    public function getMalfunctionChance(): float
    {
        return $this->malfunctionChance;
    }

    public function setMalfunctionChance(float $malfunctionChance): ItemPropertiesMagazineInterface
    {
        $this->malfunctionChance = $malfunctionChance;

        return $this;
    }

    public function getAllowedAmmo(): ?Collection
    {
        return $this->allowedAmmo;
    }

    public function setAllowedAmmo(?Collection $allowedAmmo): ItemPropertiesMagazineInterface
    {
        $this->allowedAmmo = $allowedAmmo;

        return $this;
    }

    public function addAllowedAmmo(ItemInterface $ammo): ItemPropertiesMagazineInterface
    {
        if (!$this->allowedAmmo->contains($ammo)) {
            $this->allowedAmmo->add($ammo);
            $ammo->addAllowedMagazine($this);
        }

        return $this;
    }

    public function removeAllowedAmmo(ItemInterface $ammo): ItemPropertiesMagazineInterface
    {
        if ($this->allowedAmmo->contains($ammo)) {
            $this->allowedAmmo->removeElement($ammo);
            $ammo->removeAllowedMagazine($this);
        }

        return $this;
    }
}
