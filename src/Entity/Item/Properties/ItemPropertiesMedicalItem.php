<?php

declare(strict_types=1);

namespace App\Entity\Item\Properties;

use App\Interfaces\Item\Properties\ItemPropertiesInterface;
use App\Interfaces\Item\Properties\ItemPropertiesMedicalItemInterface;
use App\Repository\Item\Properties\ItemPropertiesMedicalItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_medical_item', options: ['comment' => 'Таблица свойств для мед. предметов'])]
#[ORM\Entity(repositoryClass: ItemPropertiesMedicalItemRepository::class)]
class ItemPropertiesMedicalItem extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesMedicalItemInterface
{
    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Используется кол-во раз'])]
    private int $uses;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Время использования'])]
    private int $useTime;

    #[ORM\Column(type: 'json', nullable: true, options: ["jsonb" => true, 'comment' => ''])]
    private ?array $cures = null;

    public function getUses(): int
    {
        return $this->uses;
    }

    public function setUses(int $uses): ItemPropertiesMedicalItemInterface
    {
        $this->uses = $uses;

        return $this;
    }

    public function getUseTime(): int
    {
        return $this->useTime;
    }

    public function setUseTime(int $useTime): ItemPropertiesMedicalItemInterface
    {
        $this->useTime = $useTime;

        return $this;
    }

    public function getCures(): ?array
    {
        return $this->cures;
    }

    public function setCures(?array $cures): self
    {
        $this->cures = $cures;

        return $this;
    }
}
