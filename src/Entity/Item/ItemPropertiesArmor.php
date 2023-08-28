<?php

declare(strict_types=1);

namespace App\Entity\Item;

use App\Interfaces\Item\ArmorMaterialInterface;
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

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Прочность'])]
    private int $durability;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Стоимость ремонта за 1 ед.'])]
    private int $repairCost;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Снижение скорости в %'])]
    private int $speedPenalty;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Снижение поворота в %'])]
    private int $turnPenalty;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Снижение эргономик в %'])]
    private int $ergoPenalty;

    #[ORM\Column(type: 'json', nullable: true, options: ["jsonb" => true, 'comment' => 'Защита частей тела'])]
    private ?array $zones = null;

    #[ORM\Column(type: 'string', length: 64, nullable: false, options: ['default' => '', 'comment' => 'Тип защиты'])]
    private string $armorType;

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
