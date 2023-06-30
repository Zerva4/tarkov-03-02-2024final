<?php

declare(strict_types=1);

namespace App\Entity\Item;

use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Item\ItemTranslationRepository;
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
class ItemTranslation implements UuidPrimaryKeyInterface, TranslationInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TranslationTrait;
    use TimestampableTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private ?string $shortTitle;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShortTitle(): ?string
    {
        return $this->shortTitle;
    }

    /**
     * @param string|null $shortTitle
     */
    public function setShortTitle(?string $shortTitle): void
    {
        $this->shortTitle = $shortTitle;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}
