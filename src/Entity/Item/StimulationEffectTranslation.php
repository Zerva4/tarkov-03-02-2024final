<?php

declare(strict_types=1);

namespace App\Entity\Item;

use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Item\StimulationEffectTranslationRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;

#[ORM\Table(name: 'stimulation_effect_translation', options: ['comment' => 'Таблица переводов для эффектов стимуляции'])]
#[ORM\Entity(repositoryClass: StimulationEffectTranslationRepository::class)]
class StimulationEffectTranslation  implements UuidPrimaryKeyInterface, TranslationInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TranslationTrait;
    use TimestampableTrait;

    #[ORM\Column(type: 'string', length: 64, nullable: true, options: ['comment' => ''])]
    private ?string $type = null;

    #[ORM\Column(type: 'string', length: 64, nullable: true, options: ['comment' => ''])]
    private ?string $skillName = null;

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSkillName(): ?string
    {
        return $this->skillName;
    }

    public function setSkillName(?string $skillName): self
    {
        $this->skillName = $skillName;

        return $this;
    }
}
