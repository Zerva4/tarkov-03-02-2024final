<?php

declare(strict_types=1);

namespace App\Entity\Item\Properties;

use App\Interfaces\Item\Properties\ItemPropertiesInterface;
use App\Interfaces\Item\Properties\ItemPropertiesMedKitInterface;
use App\Repository\Item\ItemPropertiesMedKitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_med_kit', options: ['comment' => 'Таблица свойств для мед. аптечки'])]
#[ORM\Entity(repositoryClass: ItemPropertiesMedKitRepository::class)]
class ItemPropertiesMedKit extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesMedKitInterface
{
    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Очки здоровья'])]
    private int $hitPoints;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Время использования'])]
    private int $useTime;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Макс. лечение за использование'])]
    private int $maxHealPerUse;

    #[ORM\Column(type: 'json', nullable: true, options: ["jsonb" => true, 'comment' => 'Зоны излечения'])]
    private ?array $cures = null;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Кол-во очков за слабое кровотечение'])]
    private int $hpCostLightBleeding;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Кол-во очков за сильное кровотечение'])]
    private int $hpCostHeavyBleeding;

    public function getHitPoints(): int
    {
        return $this->hitPoints;
    }

    public function setHitPoints(int $hitPoints): ItemPropertiesMedKitInterface
    {
        $this->hitPoints = $hitPoints;

        return $this;
    }

    public function getUseTime(): int
    {
        return $this->useTime;
    }

    public function setUseTime(int $useTime): ItemPropertiesMedKitInterface
    {
        $this->useTime = $useTime;

        return $this;
    }

    public function getMaxHealPerUse(): int
    {
        return $this->maxHealPerUse;
    }

    public function setMaxHealPerUse(int $maxHealPerUse): ItemPropertiesMedKitInterface
    {
        $this->maxHealPerUse = $maxHealPerUse;

        return $this;
    }

    public function getCures(): ?array
    {
        return $this->cures;
    }

    public function setCures(?array $cures): ItemPropertiesMedKitInterface
    {
        $this->cures = $cures;

        return $this;
    }

    public function getHpCostLightBleeding(): int
    {
        return $this->hpCostLightBleeding;
    }

    public function setHpCostLightBleeding(int $hpCostLightBleeding): ItemPropertiesMedKitInterface
    {
        $this->hpCostLightBleeding = $hpCostLightBleeding;

        return $this;
    }

    public function getHpCostHeavyBleeding(): int
    {
        return $this->hpCostHeavyBleeding;
    }

    public function setHpCostHeavyBleeding(int $hpCostHeavyBleeding): ItemPropertiesMedKitInterface
    {
        $this->hpCostHeavyBleeding = $hpCostHeavyBleeding;

        return $this;
    }
}
