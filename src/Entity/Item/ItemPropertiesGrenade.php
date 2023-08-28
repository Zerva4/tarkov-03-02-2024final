<?php

namespace App\Entity\Item;

use App\Interfaces\Item\ItemPropertiesGrenadeInterface;
use App\Interfaces\Item\ItemPropertiesInterface;
use App\Repository\Item\ItemPropertiesGrenadeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_grenade', options: ['comment' => 'Таблица свойств для гранат'])]
#[ORM\Entity(repositoryClass: ItemPropertiesGrenadeRepository::class)]
class ItemPropertiesGrenade extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesGrenadeInterface
{
    #[ORM\Column(type: 'string', length: 32, nullable: false, options: ['default' => '', 'comment' => 'Тип гранаты'])]
    private string $type;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0.0, 'comment' => 'Задержка перед взрывом'])]
    private float $fuse;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Мин. расстояние взрыва'])]
    private float $minExplosionDistance;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Макс. расстояние взрыва'])]
    private float $maxExplosionDistance;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Кол-во осколков'])]
    private float $fragments;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Радиус кантузии'])]
    private float $contusionRadius;

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): ItemPropertiesGrenadeInterface
    {
        $this->type = $type;

        return $this;
    }

    public function getFuse(): float
    {
        return $this->fuse;
    }

    public function setFuse(float $fuse): ItemPropertiesGrenadeInterface
    {
        $this->fuse = $fuse;

        return $this;
    }

    public function getMinExplosionDistance(): float
    {
        return $this->minExplosionDistance;
    }

    public function setMinExplosionDistance(float $minExplosionDistance): ItemPropertiesGrenadeInterface
    {
        $this->minExplosionDistance = $minExplosionDistance;

        return $this;
    }

    public function getMaxExplosionDistance(): float
    {
        return $this->maxExplosionDistance;
    }

    public function setMaxExplosionDistance(float $maxExplosionDistance): ItemPropertiesGrenadeInterface
    {
        $this->maxExplosionDistance = $maxExplosionDistance;

        return $this;
    }

    public function getFragments(): float
    {
        return $this->fragments;
    }

    public function setFragments(float $fragments): ItemPropertiesGrenadeInterface
    {
        $this->fragments = $fragments;

        return $this;
    }

    public function getContusionRadius(): float
    {
        return $this->contusionRadius;
    }

    public function setContusionRadius(float $contusionRadius): ItemPropertiesGrenadeInterface
    {
        $this->contusionRadius = $contusionRadius;

        return $this;
    }
}
