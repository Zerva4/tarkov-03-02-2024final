<?php

namespace App\Entity\Item\Properties;

use App\Entity\Item\Item;
use App\Interfaces\Item\ItemInterface;
use App\Interfaces\Item\Properties\ItemPropertiesInterface;
use App\Interfaces\Item\Properties\ItemPropertiesPresetInterface;
use App\Repository\Item\Properties\ItemPropertiesPresetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_preset', options: ['comment' => ''])]
#[ORM\Entity(repositoryClass: ItemPropertiesPresetRepository::class)]
class ItemPropertiesPreset extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesPresetInterface
{
    #[ORM\ManyToOne(targetEntity: Item::class, cascade: ['persist'], fetch: 'EAGER')]
    #[ORM\JoinColumn(referencedColumnName: 'id', unique: false, onDelete: 'SET NULL', options: ['default' => null, 'comment' => 'Базовое оружие'])]
    private ?ItemInterface $baseItem = null;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Эргономика'])]
    private float $ergonomics = 0;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Вертикальная отдача'])]
    private int $recoilVertical = 0;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Горизонтальная отдача'])]
    private int $recoilHorizontal = 0;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Эргономика'])]
    private float $moa = 0;

    #[ORM\Column(type: 'boolean', nullable: false, options: ['default' => false, 'comment' => 'Эргономика'])]
    private bool $default = false;

    public function getBaseItem(): ?ItemInterface
    {
        return $this->baseItem;
    }

    public function setBaseItem(?ItemInterface $baseItem): ItemPropertiesPresetInterface
    {
        $this->baseItem = $baseItem;

        return $this;
    }

    public function getErgonomics(): float
    {
        return $this->ergonomics;
    }

    public function setErgonomics(float $ergonomics): ItemPropertiesPresetInterface
    {
        $this->ergonomics = $ergonomics;

        return $this;
    }

    public function getRecoilVertical(): int
    {
        return $this->recoilVertical;
    }

    public function setRecoilVertical(int $recoilVertical): ItemPropertiesPresetInterface
    {
        $this->recoilVertical = $recoilVertical;

        return $this;
    }

    public function getRecoilHorizontal(): int
    {
        return $this->recoilHorizontal;
    }

    public function setRecoilHorizontal(int $recoilHorizontal): ItemPropertiesPresetInterface
    {
        $this->recoilHorizontal = $recoilHorizontal;

        return $this;
    }

    public function getMoa(): float
    {
        return $this->moa;
    }

    public function setMoa(float $moa): ItemPropertiesPresetInterface
    {
        $this->moa = $moa;

        return $this;
    }

    public function isDefault(): bool
    {
        return $this->default;
    }

    public function setDefault(bool $default): ItemPropertiesPresetInterface
    {
        $this->default = $default;

        return $this;
    }
}
