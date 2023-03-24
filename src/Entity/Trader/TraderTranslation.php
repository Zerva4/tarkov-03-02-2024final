<?php

declare(strict_types=1);

namespace App\Entity\Trader;

use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Trader\TraderTranslationRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;

#[ORM\Table(name: 'traders_translation')]
#[ORM\Index(columns: ['locale'], name: 'traders_translation_idx')]
#[ORM\Entity(repositoryClass: TraderTranslationRepository::class)]
#[ORM\HasLifecycleCallbacks]
class TraderTranslation implements UuidPrimaryKeyInterface, TranslationInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;
    use TranslationTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $fullName = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $characterType;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(?string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getCharacterType(): ?string
    {
        return $this->characterType;
    }

    public function setCharacterType(string $characterType): self
    {
        $this->characterType = $characterType;

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
     * @param string|null $description
     * @return TraderTranslation
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
