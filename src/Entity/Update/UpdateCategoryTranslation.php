<?php

declare(strict_types=1);

namespace App\Entity\Update;

use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Update\UpdateCategoryTranslationRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;

#[ORM\Table(name: 'updates_category_translation')]
#[ORM\Entity(repositoryClass: UpdateCategoryTranslationRepository::class)]
class UpdateCategoryTranslation implements UuidPrimaryKeyInterface, TranslationInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;
    use TranslationTrait;
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $name;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}
