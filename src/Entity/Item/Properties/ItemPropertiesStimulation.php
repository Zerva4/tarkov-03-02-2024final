<?php

namespace App\Entity\Item\Properties;

use App\Entity\Item\StimulationEffect;
use App\Interfaces\Item\Properties\ItemPropertiesInterface;
use App\Interfaces\Item\Properties\ItemPropertiesStimulationInterface;
use App\Interfaces\Item\StimulationEffectInterface;
use App\Repository\Item\Properties\ItemPropertiesStimulationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_stimulation', options: ['comment' => 'Свойства стимуляции'])]
#[ORM\Entity(repositoryClass: ItemPropertiesStimulationRepository::class)]
class ItemPropertiesStimulation extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesStimulationInterface
{
    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Время действия'])]
    private int $useTime;

    #[ORM\Column(type: 'json', nullable: true, options: ["jsonb" => true, 'comment' => ''])]
    private ?array $cures = null;

    #[ORM\OneToMany(mappedBy: 'properties', targetEntity: StimulationEffect::class, cascade: ['persist'], fetch: 'EAGER')]
    #[ORM\JoinColumn(referencedColumnName: 'id', unique: false, onDelete: 'CASCADE')]
    private Collection $stimulationEffects;

    public function __construct()
    {
        $this->stimulationEffects = new ArrayCollection();
    }

    public function getUseTime(): int
    {
        return $this->useTime;
    }

    public function setUseTime(int $useTime): ItemPropertiesStimulationInterface
    {
        $this->useTime = $useTime;

        return $this;
    }

    public function getCures(): ?array
    {
        return $this->cures;
    }

    public function setCures(?array $cures): ItemPropertiesStimulationInterface
    {
        $this->cures = $cures;

        return $this;
    }

    public function getStimulationEffects(): Collection
    {
        return $this->stimulationEffects;
    }

    public function setStimulationEffects(Collection $stimulationEffects): ItemPropertiesStimulationInterface
    {
        $this->stimulationEffects = $stimulationEffects;

        return $this;
    }

    public function addStimulationEffect(StimulationEffectInterface $stimulationEffect): ItemPropertiesStimulationInterface
    {
        if (!$this->stimulationEffects->contains($stimulationEffect)) {
            $this->stimulationEffects->add($stimulationEffect);
            $stimulationEffect->setProperties($this);
        }

        return $this;
    }

    public function removeStimulationEffect(StimulationEffectInterface $stimulationEffect): ItemPropertiesStimulationInterface
    {
        if ($this->stimulationEffects->contains($stimulationEffect)) {
            $this->stimulationEffects->removeElement($stimulationEffect);
            $stimulationEffect->setProperties(null);
        }

        return $this;
    }
}
