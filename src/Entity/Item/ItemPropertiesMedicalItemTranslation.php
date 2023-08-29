<?php

namespace App\Entity\Item;

use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Item\ItemPropertiesMedicalItemTranslationRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;

#[ORM\Table(name: 'items_properties_medical_item_translation', options: ['comment' => 'Таблица переводов для мед. предметов'])]

#[ORM\Entity(repositoryClass: ItemPropertiesMedicalItemTranslationRepository::class)]
class ItemPropertiesMedicalItemTranslation implements UuidPrimaryKeyInterface, TranslationInterface
{
    use UuidPrimaryKeyTrait;
    use TranslationTrait;
    use TimestampableTrait;

    #[ORM\Column(type: 'json', nullable: true, options: ["jsonb" => true, 'comment' => ''])]
    private ?array $cures = null;

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
