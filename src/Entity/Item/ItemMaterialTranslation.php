<?php

declare(strict_types=1);

namespace App\Entity\Item;

use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Item\ItemMaterialTranslationRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;

#[ORM\Table(name: 'items_materials_translation')]
#[ORM\Index(columns: ['locale'], name: 'item_material_locale_idx')]
#[ORM\Entity(repositoryClass: ItemMaterialTranslationRepository::class)]
class ItemMaterialTranslation implements UuidPrimaryKeyInterface, TranslationInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TranslationTrait;
    use TimestampableTrait;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}