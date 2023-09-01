<?php

declare(strict_types=1);

namespace App\Entity\Item;

use App\Interfaces\Item\ItemPropertiesInterface;
use App\Interfaces\Item\ItemPropertiesScopeInterface;
use App\Repository\Item\ItemPropertiesScopeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_scope', options: ['comment' => 'Свойства прицелов'])]
#[ORM\Entity(repositoryClass: ItemPropertiesScopeRepository::class)]
class ItemPropertiesScope  extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesScopeInterface
{
    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Эгономика'])]
    private float $ergonomics;

    #[ORM\Column(type: 'json', nullable: true, options: ["jsonb" => true, 'comment' => 'Режимы прицела'])]
    private ?array $sightModes = null;

    #[ORM\Column(type: 'int', nullable: false, options: ['default' => 0, 'comment' => 'Прицельная дальность'])]
    private int $sightingRange;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Модификатор отдачи'])]
    private float $recoilModifier;

    #[ORM\Column(type: 'json', nullable: true, options: ["jsonb" => true, 'comment' => 'Уровни масштабирования'])]
    private ?array $zoomLevels = null;

    public function getErgonomics(): float
    {
        return $this->ergonomics;
    }

    public function setErgonomics(float $ergonomics): ItemPropertiesScopeInterface
    {
        $this->ergonomics = $ergonomics;

        return $this;
    }

    public function getSightModes(): ?array
    {
        return $this->sightModes;
    }

    public function setSightModes(?array $sightModes): ItemPropertiesScopeInterface
    {
        $this->sightModes = $sightModes;

        return $this;
    }

    public function getSightingRange(): int
    {
        return $this->sightingRange;
    }

    public function setSightingRange(int $sightingRange): ItemPropertiesScopeInterface
    {
        $this->sightingRange = $sightingRange;

        return $this;
    }

    public function getRecoilModifier(): float
    {
        return $this->recoilModifier;
    }

    public function setRecoilModifier(float $recoilModifier): ItemPropertiesScopeInterface
    {
        $this->recoilModifier = $recoilModifier;

        return $this;
    }

    public function getZoomLevels(): ?array
    {
        return $this->zoomLevels;
    }

    public function setZoomLevels(?array $zoomLevels): ItemPropertiesScopeInterface
    {
        $this->zoomLevels = $zoomLevels;

        return $this;
    }
}
