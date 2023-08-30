<?php

declare(strict_types=1);

namespace App\Entity\Item;

use App\Interfaces\Item\ItemPropertiesBackpackInterface;
use App\Interfaces\Item\ItemPropertiesInterface;
use App\Repository\Item\ItemPropertiesBackpackRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_backpack', options: ['comment' => 'Таблица свойств для рюкзаков'])]
#[ORM\Entity(repositoryClass: ItemPropertiesBackpackRepository::class)]
class ItemPropertiesBackpack extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesBackpackInterface
{
    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Емкость'])]
    private int $capacity;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Снижение скорости в %'])]
    private int $speedPenalty;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Снижение поворота в %'])]
    private int $turnPenalty;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Снижение эргономик в %'])]
    private int $ergoPenalty;

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): ItemPropertiesBackpackInterface
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getSpeedPenalty(): int
    {
        return $this->speedPenalty;
    }

    public function setSpeedPenalty(int $speedPenalty): ItemPropertiesBackpackInterface
    {
        $this->speedPenalty = $speedPenalty;

        return $this;
    }

    public function getTurnPenalty(): int
    {
        return $this->turnPenalty;
    }

    public function setTurnPenalty(int $turnPenalty): ItemPropertiesBackpackInterface
    {
        $this->turnPenalty = $turnPenalty;

        return $this;
    }

    public function getErgoPenalty(): int
    {
        return $this->ergoPenalty;
    }

    public function setErgoPenalty(int $ergoPenalty): ItemPropertiesBackpackInterface
    {
        $this->ergoPenalty = $ergoPenalty;

        return $this;
    }
}
