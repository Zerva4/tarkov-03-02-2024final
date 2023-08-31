<?php

namespace App\Entity\Item;

use App\Interfaces\Item\ItemPropertiesInterface;
use App\Interfaces\Item\ItemPropertiesNightVisionInterface;
use App\Repository\Item\ItemPropertiesNightVisionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_night_vision', options: ['comment' => 'Свойства предметов ночного видения'])]
#[ORM\Entity(repositoryClass: ItemPropertiesNightVisionRepository::class)]
class ItemPropertiesNightVision extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesNightVisionInterface
{
    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Интенсивность'])]
    private float $intensity;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Интенсивность шума'])]
    private float $noiseIntensity;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Шкала шума'])]
    private float $noiseScale;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Диффузная интенсивность'])]
    private float $diffuseIntensity;

    public function getIntensity(): float
    {
        return $this->intensity;
    }

    public function setIntensity(float $intensity): ItemPropertiesNightVisionInterface
    {
        $this->intensity = $intensity;

        return $this;
    }

    public function getNoiseIntensity(): float
    {
        return $this->noiseIntensity;
    }

    public function setNoiseIntensity(float $noiseIntensity): ItemPropertiesNightVisionInterface
    {
        $this->noiseIntensity = $noiseIntensity;

        return $this;
    }

    public function getNoiseScale(): float
    {
        return $this->noiseScale;
    }

    public function setNoiseScale(float $noiseScale): ItemPropertiesNightVisionInterface
    {
        $this->noiseScale = $noiseScale;

        return $this;
    }

    public function getDiffuseIntensity(): float
    {
        return $this->diffuseIntensity;
    }

    public function setDiffuseIntensity(float $diffuseIntensity): ItemPropertiesNightVisionInterface
    {
        $this->diffuseIntensity = $diffuseIntensity;

        return $this;
    }
}
