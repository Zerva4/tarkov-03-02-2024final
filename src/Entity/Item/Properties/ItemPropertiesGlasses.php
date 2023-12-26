<?php

declare(strict_types=1);

namespace App\Entity\Item\Properties;

use App\Interfaces\Item\Properties\ItemPropertiesGlassesInterface;
use App\Interfaces\Item\Properties\ItemPropertiesInterface;
use App\Repository\Item\Properties\ItemPropertiesGlassesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_glasses', options: ['comment' => 'Таблица свойств для очков'])]
#[ORM\Entity(repositoryClass: ItemPropertiesGlassesRepository::class)]
class ItemPropertiesGlasses  extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesGlassesInterface
{
    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Класс брони'])]
    private int $class;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Прочность'])]
    private int $durability;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Стоимость ремонта за 1 ед.'])]
    private int $repairCost;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Защита от ослепления'])]
    private float $blindnessProtection;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => ''])]
    private float $bluntThroughput;

    public function getClass(): int
    {
        return $this->class;
    }

    public function setClass(int $class): ItemPropertiesGlassesInterface
    {
        $this->class = $class;

        return $this;
    }

    public function getDurability(): int
    {
        return $this->durability;
    }

    public function setDurability(int $durability): ItemPropertiesGlassesInterface
    {
        $this->durability = $durability;

        return $this;
    }

    public function getRepairCost(): int
    {
        return $this->repairCost;
    }

    public function setRepairCost(int $repairCost): ItemPropertiesGlassesInterface
    {
        $this->repairCost = $repairCost;

        return $this;
    }

    public function getBlindnessProtection(): float
    {
        return $this->blindnessProtection;
    }

    public function setBlindnessProtection(float $blindnessProtection): ItemPropertiesGlassesInterface
    {
        $this->blindnessProtection = $blindnessProtection;

        return $this;
    }

    public function getBluntThroughput(): float
    {
        return $this->bluntThroughput;
    }

    public function setBluntThroughput(float $bluntThroughput): ItemPropertiesGlassesInterface
    {
        $this->bluntThroughput = $bluntThroughput;

        return $this;
    }
}
