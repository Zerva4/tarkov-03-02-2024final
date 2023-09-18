<?php

declare(strict_types=1);

namespace App\Entity\Item;

use App\Interfaces\Item\ItemPropertiesInterface;
use App\Interfaces\Item\ItemPropertiesMeleeInterface;
use App\Repository\Item\ItemPropertiesMeleeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_melee', options: ['comment' => 'Свойства предметов для ближнего боя'])]
#[ORM\Entity(repositoryClass: ItemPropertiesMeleeRepository::class)]
class ItemPropertiesMelee extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesMeleeInterface
{
    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Рубящий урон'])]
    private int $slashDamage;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Урон ножом'])]
    private int $stabDamage;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Радиус удара'])]
    private float $hitRadius;

    public function getSlashDamage(): int
    {
        return $this->slashDamage;
    }

    public function setSlashDamage(int $slashDamage): ItemPropertiesMeleeInterface
    {
        $this->slashDamage = $slashDamage;

        return $this;
    }

    public function getStabDamage(): int
    {
        return $this->stabDamage;
    }

    public function setStabDamage(int $stabDamage): ItemPropertiesMeleeInterface
    {
        $this->stabDamage = $stabDamage;

        return $this;
    }

    public function getHitRadius(): float
    {
        return $this->hitRadius;
    }

    public function setHitRadius(float $hitRadius): ItemPropertiesMeleeInterface
    {
        $this->hitRadius = $hitRadius;

        return $this;
    }
}
