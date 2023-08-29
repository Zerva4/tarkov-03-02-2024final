<?php

namespace App\Entity\Item;

use App\Interfaces\Item\ItemPropertiesInterface;
use App\Interfaces\Item\ItemPropertiesKeyInterface;
use App\Interfaces\Item\ItemPropertiesMedicalItemInterface;
use App\Repository\Item\ItemPropertiesMedicalItemRepository;
use App\Traits\TranslatableMagicMethodsTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

#[ORM\Table(name: 'items_properties_medical_item', options: ['comment' => 'Таблица свойств для мед. предметов'])]
#[ORM\Entity(repositoryClass: ItemPropertiesMedicalItemRepository::class)]
class ItemPropertiesMedicalItem extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesMedicalItemInterface, TranslatableInterface
{
    use TranslatableTrait;
    use TranslatableMagicMethodsTrait;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Используется кол-во раз'])]
    private int $uses;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Время использования'])]
    private int $useTime;

    public function __construct(string $defaultLocale = '%app.default_locale%')
    {
        $this->defaultLocale = $defaultLocale;
    }

    public function getCures(): ?array
    {
        return $this->translate()->getCures();
    }

    public function setCures(?array $cures): ItemPropertiesMedicalItemInterface
    {
        $this->translate()->setCures($cures);

        return $this;
    }

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
}
