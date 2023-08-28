<?php

declare(strict_types=1);

namespace App\Entity\Item;

use App\Interfaces\Item\ItemPropertiesBarrelInterface;
use App\Interfaces\Item\ItemPropertiesInterface;
use App\Repository\Item\ItemPropertiesBarrelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_barrel', options: ['comment' => 'Таблица свойств для бочки'])]
#[ORM\Entity(repositoryClass: ItemPropertiesBarrelRepository::class)]
class ItemPropertiesBarrel extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesBarrelInterface
{
    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Эргономика'])]
    private int $ergonomics;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Модификатор отдачи'])]
    private int $recoilModifier;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Центр воздействия'])]
    private int $centerOfImpact;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Кривая отклонения'])]
    private int $deviationCurve;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Макс. отклонение'])]
    private int $deviationMax;

    // todo: Slots
    
    public function getErgonomics(): int
    {
        return $this->ergonomics;
    }

    public function setErgonomics(int $ergonomics): ItemPropertiesBarrelInterface
    {
        $this->ergonomics = $ergonomics;

        return $this;
    }

    public function getRecoilModifier(): int
    {
        return $this->recoilModifier;
    }

    public function setRecoilModifier(int $recoilModifier): ItemPropertiesBarrelInterface
    {
        $this->recoilModifier = $recoilModifier;

        return $this;
    }

    public function getCenterOfImpact(): int
    {
        return $this->centerOfImpact;
    }

    public function setCenterOfImpact(int $centerOfImpact): ItemPropertiesBarrelInterface
    {
        $this->centerOfImpact = $centerOfImpact;

        return $this;
    }

    public function getDeviationCurve(): int
    {
        return $this->deviationCurve;
    }

    public function setDeviationCurve(int $deviationCurve): ItemPropertiesBarrelInterface
    {
        $this->deviationCurve = $deviationCurve;

        return $this;
    }

    public function getDeviationMax(): int
    {
        return $this->deviationMax;
    }

    public function setDeviationMax(int $deviationMax): ItemPropertiesBarrelInterface
    {
        $this->deviationMax = $deviationMax;

        return $this;
    }
}
