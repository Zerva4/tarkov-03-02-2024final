<?php

declare(strict_types=1);

namespace App\Entity\Item;

use App\Interfaces\Item\ItemPropertiesInterface;
use App\Interfaces\Item\ItemPropertiesSurgicalKitInterface;
use App\Repository\Item\ItemPropertiesSurgicalKitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_surgical_kit', options: ['comment' => 'Свойства хирурнических наборов'])]
#[ORM\Entity(repositoryClass: ItemPropertiesSurgicalKitRepository::class)]
class ItemPropertiesSurgicalKit extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesSurgicalKitInterface
{
    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Используется кол-во раз'])]
    private int $uses;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Время использования'])]
    private int $useTime;

    #[ORM\Column(type: 'json', nullable: true, options: ["jsonb" => true, 'comment' => 'Зоны'])]
    private ?array $cures = null;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Мин. здоровье конечностей'])]
    private int $minLimbHealth;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Макс. здоровье конечностей'])]
    private int $maxLimbHealth;

    public function getUses(): int
    {
        return $this->uses;
    }

    public function setUses(int $uses): ItemPropertiesSurgicalKitInterface
    {
        $this->uses = $uses;

        return $this;
    }

    public function getUseTime(): int
    {
        return $this->useTime;
    }

    public function setUseTime(int $useTime): ItemPropertiesSurgicalKitInterface
    {
        $this->useTime = $useTime;

        return $this;
    }

    public function getCures(): ?array
    {
        return $this->cures;
    }

    public function setCures(?array $cures): ItemPropertiesSurgicalKitInterface
    {
        $this->cures = $cures;

        return $this;
    }

    public function getMinLimbHealth(): int
    {
        return $this->minLimbHealth;
    }

    public function setMinLimbHealth(int $minLimbHealth): ItemPropertiesSurgicalKitInterface
    {
        $this->minLimbHealth = $minLimbHealth;

        return $this;
    }

    public function getMaxLimbHealth(): int
    {
        return $this->maxLimbHealth;
    }

    public function setMaxLimbHealth(int $maxLimbHealth): ItemPropertiesSurgicalKitInterface
    {
        $this->maxLimbHealth = $maxLimbHealth;

        return $this;
    }
}
