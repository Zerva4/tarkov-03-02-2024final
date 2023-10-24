<?php

declare(strict_types=1);

namespace App\Entity\Quest;

use App\Entity\TranslatableEntity;
use App\Interfaces\Quest\QuestAdviceInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Quest\QuestAdviceRepository;
use App\Traits\UuidPrimaryKeyTrait;
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
        return $this->translate()->getBody();
    }

    public function setBody(string $body): QuestAdviceInterface
    {
        $this->translate()->setBody($body);

        return $this;
    }

    public function __toString(): string
    {
        return $this->getBody();
    }
}
