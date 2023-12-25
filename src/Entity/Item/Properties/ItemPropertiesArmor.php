<?php

declare(strict_types=1);

namespace App\Entity\Item\Properties;

use App\Interfaces\Item\Properties\ItemPropertiesArmorInterface;
use App\Interfaces\Item\Properties\ItemPropertiesInterface;
use App\Repository\Item\Properties\ItemPropertiesArmorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_armor', options: ['comment' => 'Таблица свойств для брони'])]
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
    private float $speedPenalty;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Снижение поворота в %'])]
    private float $turnPenalty;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Снижение эргономик в %'])]
    private int $ergoPenalty;

    #[ORM\Column(type: 'json', nullable: true, options: ["jsonb" => true, 'comment' => 'Защита частей тела'])]
    private ?array $zones = null;

    #[ORM\Column(type: 'string', length: 64, nullable: false, options: ['default' => '', 'comment' => 'Тип защиты'])]
    private string $armorType;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => ''])]
    private float $bluntThroughput;

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

    public function getSpeedPenalty(): float
    {
        return $this->speedPenalty;
    }

    public function setSpeedPenalty(float $speedPenalty): ItemPropertiesArmorInterface
    {
        $this->speedPenalty = $speedPenalty;

        return $this;
    }

    public function getTurnPenalty(): float
    {
        return $this->turnPenalty;
    }

    public function setTurnPenalty(float $turnPenalty): ItemPropertiesArmorInterface
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

    public function getBluntThroughput(): float
    {
        return $this->bluntThroughput;
    }

    public function setBluntThroughput(float $bluntThroughput): ItemPropertiesArmorInterface
    {
        $this->bluntThroughput = $bluntThroughput;

        return $this;
    }
}
