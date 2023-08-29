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
    private int $intensity;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Интенсивность шума'])]
    private int $noiseIntensity;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Шкала шума'])]
    private int $noiseScale;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Диффузная интенсивность'])]
    private int $diffuseIntensity;

    public function getIntensity(): int
    {
        return $this->intensity;
    }

    public function setIntensity(int $intensity): ItemPropertiesNightVisionInterface
    {
        $this->intensity = $intensity;

        return $this;
    }

    public function getNoiseIntensity(): int
    {
        return $this->noiseIntensity;
    }

    public function setNoiseIntensity(int $noiseIntensity): ItemPropertiesNightVisionInterface
    {
        $this->noiseIntensity = $noiseIntensity;

        return $this;
    }

    public function getNoiseScale(): int
    {
        return $this->noiseScale;
    }

    public function setNoiseScale(int $noiseScale): ItemPropertiesNightVisionInterface
    {
        $this->noiseScale = $noiseScale;

        return $this;
    }

    public function getDiffuseIntensity(): int
    {
        return $this->diffuseIntensity;
    }

    public function setDiffuseIntensity(int $diffuseIntensity): ItemPropertiesNightVisionInterface
    {
        $this->diffuseIntensity = $diffuseIntensity;

        return $this;
    }
}
