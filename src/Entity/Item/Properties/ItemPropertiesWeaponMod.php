<?php

declare(strict_types=1);

namespace App\Entity\Item\Properties;

use App\Interfaces\Item\Properties\ItemPropertiesInterface;
use App\Interfaces\Item\Properties\ItemPropertiesWeaponModInterface;
use App\Repository\Item\ItemPropertiesWeaponModRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_weapon_mod', options: ['comment' => 'Свойства для модификаций оружия'])]
#[ORM\Entity(repositoryClass: ItemPropertiesWeaponModRepository::class)]
class ItemPropertiesWeaponMod extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesWeaponModInterface
{
    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Эргономика'])]
    private float $ergonomics;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Отдача в процентах'])]
    private float $recoilModifier;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Точность в процентах'])]
    private float $accuracyModifier;

    // todo: Slots

    public function getErgonomics(): float
    {
        return $this->ergonomics;
    }

    public function setErgonomics(float $ergonomics): ItemPropertiesWeaponModInterface
    {
        $this->ergonomics = $ergonomics;

        return $this;
    }

    public function getRecoilModifier(): float
    {
        return $this->recoilModifier;
    }

    public function setRecoilModifier(float $recoilModifier): ItemPropertiesWeaponModInterface
    {
        $this->recoilModifier = $recoilModifier;

        return $this;
    }

    public function getAccuracyModifier(): float
    {
        return $this->accuracyModifier;
    }

    public function setAccuracyModifier(float $accuracyModifier): ItemPropertiesWeaponModInterface
    {
        $this->accuracyModifier = $accuracyModifier;

        return $this;
    }
}
