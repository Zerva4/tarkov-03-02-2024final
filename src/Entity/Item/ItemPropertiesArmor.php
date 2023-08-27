<?php

namespace App\Entity\Item;

use App\Interfaces\Item\ItemPropertiesAmmoInterface;
use App\Interfaces\Item\ItemPropertiesArmorInterface;
use App\Interfaces\Item\ItemPropertiesInterface;
use App\Repository\Item\ItemPropertiesArmorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_armor', options: ['comment' => 'Таблица брони'])]
#[ORM\Entity(repositoryClass: ItemPropertiesArmorRepository::class)]
class ItemPropertiesArmor extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesArmorInterface
{
    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Класс брони'])]
    private int $class;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Долговечность'])]
    private int $durability;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Стоимост ремонта'])]
    private int $repairCost;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Коэффициент снижения скорости'])]
    private int $speedPenalty;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Коэффициент снижения поворотливости'])]
    private int $turnPenalty;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Коэффициент снижения эргономики'])]
    private int $ergoPenalty;

    #[ORM\Column(type: 'json', nullable: true, options: ["jsonb" => true, 'comment' => 'Части тела'])]
    private ?array $zones = null;

    #[ORM\Column(type: 'string', length: 64, nullable: false, options: ['default' => '', 'comment' => 'Тип брони'])]
    private string $armorType;

    // todo: Сдклать связь с материалом брони (ArmorMaterial entity).

    public function getClass(): int
    {
        return $this->class;
    }

    public function setClass(int $class): ItemPropertiesArmorInterface
    {
        $this->class = $class;

        return $this;
    }

    public function getDurability(): int
    {
        return $this->durability;
    }

    public function setDurability(int $durability): ItemPropertiesArmorInterface
    {
        $this->durability = $durability;

        return $this;
    }

    public function getRepairCost(): int
    {
        return $this->repairCost;
    }

    public function setRepairCost(int $repairCost): ItemPropertiesArmorInterface
    {
        $this->repairCost = $repairCost;

        return $this;
    }

    public function getSpeedPenalty(): int
    {
        return $this->speedPenalty;
    }

    public function setSpeedPenalty(int $speedPenalty): ItemPropertiesArmorInterface
    {
        $this->speedPenalty = $speedPenalty;

        return $this;
    }

    public function getTurnPenalty(): int
    {
        return $this->turnPenalty;
    }

    public function setTurnPenalty(int $turnPenalty): ItemPropertiesArmorInterface
    {
        $this->turnPenalty = $turnPenalty;

        return $this;
    }

    public function getErgoPenalty(): int
    {
        return $this->ergoPenalty;
    }

    public function setErgoPenalty(int $ergoPenalty): ItemPropertiesArmorInterface
    {
        $this->ergoPenalty = $ergoPenalty;

        return $this;
    }

    public function getZones(): ?array
    {
        return $this->zones;
    }

    public function setZones(?array $zones): ItemPropertiesArmorInterface
    {
        $this->zones = $zones;

        return $this;
    }

    public function getArmorType(): string
    {
        return $this->armorType;
    }

    public function setArmorType(string $armorType): ItemPropertiesArmorInterface
    {
        $this->armorType = $armorType;

        return $this;
    }
}
