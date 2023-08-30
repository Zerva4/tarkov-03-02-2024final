<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\MapTranslationRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;

#[ORM\Table(name: 'maps_translation')]
#[ORM\Index(columns: ['locale'], name: 'maps_locale_idx')]
#[ORM\Entity(repositoryClass: MapTranslationRepository::class)]
#[ORM\HasLifecycleCallbacks]
class MapTranslation implements UuidPrimaryKeyInterface, TranslationInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TranslationTrait;
    use TimestampableTrait;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name;

    #[ORM\Column(type: 'text')]
    private string $description;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
