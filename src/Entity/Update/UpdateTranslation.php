<?php

namespace App\Entity\Update;

use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Update\UpdateTranslationRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;

#[ORM\Table(name: 'updates_translation')]
#[ORM\Entity(repositoryClass: UpdateTranslationRepository::class)]
class UpdateTranslation  implements UuidPrimaryKeyInterface, TranslationInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;
    use TranslationTrait;

    #[ORM\Column(type: 'text', nullable: false)]
    private string $description;

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
}
