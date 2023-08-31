<?php

declare(strict_types=1);

namespace App\Entity\Item;

use App\Interfaces\Item\ItemPropertiesFoodDrinkInterface;
use App\Interfaces\Item\ItemPropertiesInterface;
use App\Interfaces\Item\StimulationEffectInterface;
use App\Repository\Item\ItemPropertiesFoodDrinkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'properties', targetEntity: StimulationEffect::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    #[ORM\JoinColumn(referencedColumnName: 'id', nullable: true, onDelete: 'CASCADE')]
    private Collection $stimulationEffects;

    public function __construct()
    {
        $this->stimulationEffects = new ArrayCollection();
    }

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

    public function getStimulationEffects(): Collection
    {
        return $this->stimulationEffects;
    }

    public function setStimulationEffects(Collection $stimulationEffects): ItemPropertiesFoodDrinkInterface
    {
        $this->stimulationEffects = $stimulationEffects;

        return $this;
    }

    public function addStimulationEffect(StimulationEffectInterface $stimulationEffect): ItemPropertiesFoodDrinkInterface
    {
        if (!$this->stimulationEffects->contains($stimulationEffect)) {
            $this->stimulationEffects->add($stimulationEffect);
            $stimulationEffect->setProperties($this);
        }

        return $this;
    }

    public function removeStimulationEffect(StimulationEffectInterface $stimulationEffect): ItemPropertiesFoodDrinkInterface
    {
        if ($this->stimulationEffects->contains($stimulationEffect)) {
            $this->stimulationEffects->removeElement($stimulationEffect);
            if ($stimulationEffect->getProperties() === $this) $stimulationEffect->setProperties(null);
        }

        return $this;
    }
}
