<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ItemTranslationRepository;
use App\Repository\QuestTranslationRepository;
use App\Traits\TranslatableMagicMethodsTrait;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;

#[ORM\Table(name: 'items_translation')]
#[ORM\Index(columns: ['locale'], name: 'item_locale_idx')]
#[ORM\Entity(repositoryClass: ItemTranslationRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ItemTranslation implements TranslationInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TranslationTrait;
    use TimestampableTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $title;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
