<?php

declare(strict_types=1);

namespace App\Entity\Item;

use App\Interfaces\Item\ItemPropertiesChestRigInterface;
use App\Interfaces\Item\ItemPropertiesInterface;
use App\Repository\Item\ItemPropertiesChestRigRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_chest_rig', options: ['comment' => 'Таблица свойств для разгрозочного жилета'])]
#[ORM\Entity(repositoryClass: ItemPropertiesChestRigRepository::class)]
class ItemPropertiesChestRig extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesChestRigInterface
{
    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Класс'])]
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

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Емкость'])]
    private int $capacity;

    #[ORM\Column(type: 'string', length: 64, nullable: false, options: ['default' => '', 'comment' => 'Тип защиты'])]
    private string $armorType;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => ''])]
    private float $bluntThroughput;

    public function getClass(): int
    {
        return $this->class;
    }

    public function setClass(int $class): ItemPropertiesChestRigInterface
    {
        $this->class = $class;

        return $this;
    }

    public function getDurability(): int
    {
        return $this->durability;
    }

    public function setDurability(int $durability): ItemPropertiesChestRigInterface
    {
        $this->durability = $durability;

        return $this;
    }

    public function getRepairCost(): int
    {
        return $this->repairCost;
    }

    public function setRepairCost(int $repairCost): ItemPropertiesChestRigInterface
    {
        $this->repairCost = $repairCost;

        return $this;
    }

    public function getSpeedPenalty(): float
    {
        return $this->speedPenalty;
    }

    public function setSpeedPenalty(float $speedPenalty): ItemPropertiesChestRigInterface
    {
        $this->speedPenalty = $speedPenalty;

        return $this;
    }

    public function getTurnPenalty(): float
    {
        return $this->turnPenalty;
    }

    public function setTurnPenalty(float $turnPenalty): ItemPropertiesChestRigInterface
    {
        $this->turnPenalty = $turnPenalty;

        return $this;
    }

    public function getErgoPenalty(): int
    {
        return $this->ergoPenalty;
    }

    public function setErgoPenalty(int $ergoPenalty): ItemPropertiesChestRigInterface
    {
        $this->ergoPenalty = $ergoPenalty;

        return $this;
    }

    public function getZones(): ?array
    {
        return $this->zones;
    }

    public function setZones(?array $zones): ItemPropertiesChestRigInterface
    {
        $this->zones = $zones;

        return $this;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): ItemPropertiesChestRigInterface
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getArmorType(): string
    {
        return $this->armorType;
    }

    public function setArmorType(string $armorType): ItemPropertiesChestRigInterface
    {
        $this->armorType = $armorType;

        return $this;
    }

    public function getBluntThroughput(): float
    {
        return $this->bluntThroughput;
    }

    public function setBluntThroughput(float $bluntThroughput): ItemPropertiesChestRigInterface
    {
        $this->bluntThroughput = $bluntThroughput;

        return $this;
    }
}
