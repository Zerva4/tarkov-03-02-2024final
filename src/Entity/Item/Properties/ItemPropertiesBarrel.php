<?php

declare(strict_types=1);

namespace App\Entity\Item\Properties;

use App\Interfaces\Item\Properties\ItemPropertiesBarrelInterface;
use App\Interfaces\Item\Properties\ItemPropertiesInterface;
use App\Repository\Item\Properties\ItemPropertiesBarrelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_barrel', options: ['comment' => 'Таблица свойств для бочки'])]
#[ORM\Entity(repositoryClass: ItemPropertiesBarrelRepository::class)]
class ItemPropertiesBarrel extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesBarrelInterface
{
    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Эргономика'])]
    private float $ergonomics;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Модификатор отдачи'])]
    private float $recoilModifier;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Центр воздействия'])]
    private float $centerOfImpact;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Кривая отклонения'])]
    private float $deviationCurve;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Макс. отклонение'])]
    private float $deviationMax;

    // todo: Slots
    
    public function getErgonomics(): float
    {
        return $this->ergonomics;
    }

    public function setErgonomics(float $ergonomics): ItemPropertiesBarrelInterface
    {
        $this->ergonomics = $ergonomics;

        return $this;
    }

    public function getRecoilModifier(): float
    {
        return $this->recoilModifier;
    }

    public function setRecoilModifier(float $recoilModifier): ItemPropertiesBarrelInterface
    {
        $this->recoilModifier = $recoilModifier;

        return $this;
    }

    public function getCenterOfImpact(): float
    {
        return $this->centerOfImpact;
    }

    public function setCenterOfImpact(float $centerOfImpact): ItemPropertiesBarrelInterface
    {
        $this->centerOfImpact = $centerOfImpact;

        return $this;
    }

    public function getDeviationCurve(): float
    {
        return $this->deviationCurve;
    }

    public function setDeviationCurve(float $deviationCurve): ItemPropertiesBarrelInterface
    {
        $this->deviationCurve = $deviationCurve;

        return $this;
    }

    public function getDeviationMax(): float
    {
        return $this->deviationMax;
    }

    public function setDeviationMax(float $deviationMax): ItemPropertiesBarrelInterface
    {
        $this->deviationMax = $deviationMax;

        return $this;
    }
}
