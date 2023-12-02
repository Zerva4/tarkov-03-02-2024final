<?php

namespace App\Entity\Item\Properties;

use App\Entity\Item\StimulationEffect;
use App\Interfaces\Item\Properties\ItemPropertiesInterface;
use App\Interfaces\Item\Properties\ItemPropertiesStimulationInterface;
use App\Interfaces\Item\StimulationEffectInterface;
use App\Repository\Item\Properties\ItemPropertiesStimulationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_stimulation', options: ['comment' => 'Свойства стимуляции'])]
#[ORM\Entity(repositoryClass: ItemPropertiesStimulationRepository::class)]
class ItemPropertiesStimulation extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesStimulationInterface
{
    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Время действия'])]
    private int $useTime = 0;

    #[ORM\Column(type: 'json', nullable: true, options: ["jsonb" => true, 'comment' => ''])]
    private ?array $cures = null;

    #[ORM\OneToOne(targetEntity: StimulationEffect::class, cascade: ['persist'], fetch: 'EAGER')]
    #[ORM\JoinColumn(referencedColumnName: 'id', unique: false, onDelete: 'CASCADE')]
    private ?StimulationEffectInterface $stimulationEffect = null;

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

    public function getStimulationEffect(): ?StimulationEffectInterface
    {
        return $this->stimulationEffect;
    }

    public function setStimulationEffect(?StimulationEffectInterface $stimulationEffect): ItemPropertiesStimulationInterface
    {
        $this->stimulationEffect = $stimulationEffect;

        return $this;
    }
}
