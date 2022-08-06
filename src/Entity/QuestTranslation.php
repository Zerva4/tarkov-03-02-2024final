<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\QuestTranslationRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;

#[ORM\Table(name: 'quests_translation')]
#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: QuestTranslationRepository::class)]
class QuestTranslation implements TranslationInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TranslationTrait;
    use TimestampableTrait;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title;

    #[ORM\Column(type: 'text')]
    private ?string $description;

    #[ORM\Column(type: 'text')]
    private ?string $howToComplete;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $goals = null;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getHowToComplete(): ?string
    {
        return $this->howToComplete;
    }

    public function setHowToComplete(string $howToComplete): self
    {
        $this->howToComplete = $howToComplete;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getGoals(): ?string
    {
        return $this->goals;
    }

    /**
     * @param string|null $goals
     */
    public function setGoals(?string $goals): self
    {
        $this->goals = $goals;

        return $this;
    }
}
