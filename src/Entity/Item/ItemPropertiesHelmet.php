<?php

declare(strict_types=1);

namespace App\Entity\Item;

use App\Interfaces\Item\ItemPropertiesHelmetInterface;
use App\Interfaces\Item\ItemPropertiesInterface;
use App\Repository\Item\ItemPropertiesHelmetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_headphone', options: ['comment' => 'Таблица свойств для шлемов'])]
#[ORM\Entity(repositoryClass: ItemPropertiesHelmetRepository::class)]
class ItemPropertiesHelmet extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesHelmetInterface
{
    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Класс'])]
    private int $class;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Прочность'])]
    private int $durability;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Стоимость ремонта за 1 ед.'])]
    private int $repairCost;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Снижение скорости в %'])]
    private int $speedPenalty;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Снижение поворота в %'])]
    private int $turnPenalty;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Снижение эргономик в %'])]
    private int $ergoPenalty;

    #[ORM\Column(type: 'json', nullable: true, options: ["jsonb" => true, 'comment' => 'Защита зон головы'])]
    private ?array $headZones = null;

    #[ORM\Column(type: 'string', length: 16, nullable: false, options: ['default' => '', 'comment' => ''])]
    private string $deafening;

    #[ORM\Column(type: 'boolean', nullable: false, options: ['default' => false, 'comment' => 'Блокировка наушников'])]
    private bool $blockHeadset;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Защита от ослепления'])]
    private float $blindnessProtection;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => ''])]
    private float $ricochetX;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => ''])]
    private float $ricochetY;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => ''])]
    private float $ricochetZ;

    #[ORM\Column(type: 'string', length: 64, nullable: false, options: ['default' => '', 'comment' => 'Тип защиты'])]
    private string $armorType;

    public function getClass(): int
    {
        return $this->class;
    }

    public function setClass(int $class): ItemPropertiesHelmetInterface
    {
        $this->class = $class;

        return $this;
    }

    public function getDurability(): int
    {
        return $this->durability;
    }

    public function setDurability(int $durability): ItemPropertiesHelmetInterface
    {
        $this->durability = $durability;

        return $this;
    }

    public function getRepairCost(): int
    {
        return $this->repairCost;
    }

    public function setRepairCost(int $repairCost): ItemPropertiesHelmetInterface
    {
        $this->repairCost = $repairCost;

        return $this;
    }

    public function getSpeedPenalty(): int
    {
        return $this->speedPenalty;
    }

    public function setSpeedPenalty(int $speedPenalty): ItemPropertiesHelmetInterface
    {
        $this->speedPenalty = $speedPenalty;

        return $this;
    }

    public function getTurnPenalty(): int
    {
        return $this->turnPenalty;
    }

    public function setTurnPenalty(int $turnPenalty): ItemPropertiesHelmetInterface
    {
        $this->turnPenalty = $turnPenalty;

        return $this;
    }

    public function getErgoPenalty(): int
    {
        return $this->ergoPenalty;
    }

    public function setErgoPenalty(int $ergoPenalty): ItemPropertiesHelmetInterface
    {
        $this->ergoPenalty = $ergoPenalty;

        return $this;
    }

    public function getHeadZones(): ?array
    {
        return $this->headZones;
    }

    public function setHeadZones(?array $headZones): ItemPropertiesHelmetInterface
    {
        $this->headZones = $headZones;

        return $this;
    }

    public function getDeafening(): string
    {
        return $this->deafening;
    }

    public function setDeafening(string $deafening): ItemPropertiesHelmetInterface
    {
        $this->deafening = $deafening;

        return $this;
    }

    public function isBlockHeadset(): bool
    {
        return $this->blockHeadset;
    }

    public function setBlockHeadset(bool $blockHeadset): ItemPropertiesHelmetInterface
    {
        $this->blockHeadset = $blockHeadset;

        return $this;
    }

    public function getBlindnessProtection(): float
    {
        return $this->blindnessProtection;
    }

    public function setBlindnessProtection(float $blindnessProtection): ItemPropertiesHelmetInterface
    {
        $this->blindnessProtection = $blindnessProtection;

        return $this;
    }

    public function getRicochetX(): float
    {
        return $this->ricochetX;
    }

    public function setRicochetX(float $ricochetX): ItemPropertiesHelmetInterface
    {
        $this->ricochetX = $ricochetX;

        return $this;
    }

    public function getRicochetY(): float
    {
        return $this->ricochetY;
    }

    public function setRicochetY(float $ricochetY): ItemPropertiesHelmetInterface
    {
        $this->ricochetY = $ricochetY;

        return $this;
    }

    public function getRicochetZ(): float
    {
        return $this->ricochetZ;
    }

    public function setRicochetZ(float $ricochetZ): ItemPropertiesHelmetInterface
    {
        $this->ricochetZ = $ricochetZ;

        return $this;
    }

    public function getArmorType(): string
    {
        return $this->armorType;
    }

    public function setArmorType(string $armorType): ItemPropertiesHelmetInterface
    {
        $this->armorType = $armorType;

        return $this;
    }
}
