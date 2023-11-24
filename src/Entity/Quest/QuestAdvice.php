<?php

declare(strict_types=1);

namespace App\Entity\Quest;

use App\Entity\TranslatableEntity;
use App\Interfaces\Quest\QuestAdviceInterface;
use App\Interfaces\Quest\QuestInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Quest\QuestAdviceRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Table(name: 'quests_advice')]
#[ORM\Entity(repositoryClass: QuestAdviceRepository::class)]
class QuestAdvice extends TranslatableEntity implements QuestAdviceInterface, UuidPrimaryKeyInterface, TranslatableInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;

    #[ORM\Column(type: 'boolean')]
    private bool $published;

    #[ORM\ManyToMany(targetEntity: Quest::class, inversedBy: 'advices', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    #[ORM\JoinTable('quests_advice_mapping')]
    private Collection $quests;

    public function __construct(string $defaultLocale = '%app.default_locale%')
    {
        parent::__construct($defaultLocale);

        $this->quests = new ArrayCollection();
    }

    public function isPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): QuestAdviceInterface
    {
        $this->published = $published;

        return $this;
    }

    public function getBody(): string
    {
        return $this->translate($this->currentLocale)->getBody();
    }

    public function setBody(string $body): QuestAdviceInterface
    {
        $this->translate($this->currentLocale)->setBody($body);

        return $this;
    }

    public function __toString(): string
    {
        return $this->getBody();
    }

    public function getQuests(): Collection
    {
        return $this->quests;
    }

    public function setQuests(Collection $quests): QuestAdviceInterface
    {
        $this->quests = $quests;

        return $this;
    }

    public function addQuest(QuestInterface $quest): QuestAdviceInterface
    {
        if (!$this->quests->contains($quest)) {
            $this->quests->add($quest);
            $quest->addAdvice($this);
        }

        return $this;
    }

    public function removeQuest(QuestInterface $quest): QuestAdviceInterface
    {
        if ($this->quests->contains($quest)) {
            $this->quests->removeElement($quest);
            $quest->removeAdvice($this);
        }

        return $this;
    }
}
