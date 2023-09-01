<?php

declare(strict_types=1);

namespace App\Entity\Item;

use App\Interfaces\Item\ItemPropertiesInterface;
use App\Interfaces\Item\ItemPropertiesPainkillerInterface;
use App\Repository\Item\ItemPropertiesPainkillerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_painkiller', options: ['comment' => 'Свойства для обезбаливающенр'])]
#[ORM\Entity(repositoryClass: ItemPropertiesPainkillerRepository::class)]
class ItemPropertiesPainkiller extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesPainkillerInterface
{
    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Используется кол-во раз'])]
    private int $uses;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Время использования'])]
    private int $useTime;

    #[ORM\Column(type: 'json', nullable: true, options: ["jsonb" => true, 'comment' => 'Зоны обезбаливания'])]
    private ?array $cures;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Продолжительность обезбаливания'])]
    private int $painkillerDuration;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Энергетическое воздействие'])]
    private int $energyImpact;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Увлажняющее воздействие'])]
    private int $hydrationImpact;

    public function getUses(): int
    {
        return $this->uses;
    }

    public function setUses(int $uses): ItemPropertiesPainkillerInterface
    {
        $this->uses = $uses;

        return $this;
    }

    public function getUseTime(): int
    {
        return $this->useTime;
    }

    public function setUseTime(int $useTime): ItemPropertiesPainkillerInterface
    {
        $this->useTime = $useTime;

        return $this;
    }

    public function getCures(): ?array
    {
        return $this->cures;
    }

    public function setCures(?array $cures): ItemPropertiesPainkillerInterface
    {
        $this->cures = $cures;

        return $this;
    }

    public function getPainkillerDuration(): int
    {
        return $this->painkillerDuration;
    }

    public function setPainkillerDuration(int $painkillerDuration): ItemPropertiesPainkillerInterface
    {
        $this->painkillerDuration = $painkillerDuration;

        return $this;
    }

    public function getEnergyImpact(): int
    {
        return $this->energyImpact;
    }

    public function setEnergyImpact(int $energyImpact): ItemPropertiesPainkillerInterface
    {
        $this->energyImpact = $energyImpact;

        return $this;
    }

    public function getHydrationImpact(): int
    {
        return $this->hydrationImpact;
    }

    public function setHydrationImpact(int $hydrationImpact): ItemPropertiesPainkillerInterface
    {
        $this->hydrationImpact = $hydrationImpact;

        return $this;
    }
}
