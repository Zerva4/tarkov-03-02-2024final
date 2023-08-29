<?php

declare(strict_types=1);

namespace App\Entity\Item;

use App\Interfaces\Item\ItemPropertiesFoodDrinkInterface;
use App\Interfaces\Item\ItemPropertiesInterface;
use App\Interfaces\Item\StimulationEffectInterface;
use App\Repository\Item\ItemPropertiesFoodDrinkRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_food_drink', options: ['comment' => 'Таблица свойств для еды и напитков'])]
#[ORM\Entity(repositoryClass: ItemPropertiesFoodDrinkRepository::class)]
class ItemPropertiesFoodDrink extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesFoodDrinkInterface
{
    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => ''])]
    private int $energy;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => ''])]
    private int $hydration;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => ''])]
    private int $units;

    #[ORM\OneToOne(inversedBy: 'properties', targetEntity: StimulationEffect::class, cascade: ['persist', 'remove'])]
    private ?StimulationEffectInterface $stimulationEffect = null;

    public function getEnergy(): int
    {
        return $this->energy;
    }

    public function setEnergy(int $energy): ItemPropertiesFoodDrinkInterface
    {
        $this->energy = $energy;

        return $this;
    }

    public function getHydration(): int
    {
        return $this->hydration;
    }

    public function setHydration(int $hydration): ItemPropertiesFoodDrinkInterface
    {
        $this->hydration = $hydration;

        return $this;
    }

    public function getUnits(): int
    {
        return $this->units;
    }

    public function setUnits(int $units): ItemPropertiesFoodDrinkInterface
    {
        $this->units = $units;

        return $this;
    }

    public function getStimulationEffect(): ?StimulationEffectInterface
    {
        return $this->stimulationEffect;
    }

    public function setStimulationEffect(?StimulationEffectInterface $stimulationEffect): ItemPropertiesFoodDrinkInterface
    {
        $this->stimulationEffect = $stimulationEffect;
        $stimulationEffect->setProperties($this);

        return $this;
    }
}
