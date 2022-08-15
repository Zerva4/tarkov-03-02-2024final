<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\QuestInterface;
use App\Interfaces\QuestObjectiveInterface;
use App\Repository\QuestObjectiveRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

#[ORM\Table(name: 'quests_objectives')]
#[ORM\Index(columns: ['type'], name: 'quest_type_idx')]
#[ORM\Entity(repositoryClass: QuestObjectiveRepository::class)]
class QuestObjective extends BaseEntity implements QuestObjectiveInterface
{
    use UuidPrimaryKeyTrait;
    use TranslatableTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $optional = false;

    #[ORM\ManyToOne(targetEntity: Quest::class, inversedBy: 'objectives')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private QuestInterface $quest;

    /**
     * Get objective type.
     *
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * Set objective type.
     *
     * @param string|null $type
     * @return QuestObjectiveInterface
     */
    public function setType(?string $type): QuestObjectiveInterface
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get is objective optional.
     *
     * @return bool
     */
    public function isOptional(): bool
    {
        return $this->optional;
    }

    /**
     * Set objective optional.
     *
     * @param bool $optional
     * @return QuestObjectiveInterface
     */
    public function setOptional(bool $optional): QuestObjectiveInterface
    {
        $this->optional = $optional;

        return $this;
    }

    /**
     * Get parent quest.
     *
     * @return QuestInterface
     */
    public function getQuest(): QuestInterface
    {
        return $this->quest;
    }

    /**
     * @param QuestInterface|null $quest
     * @return QuestObjectiveInterface
     */
    public function setQuest(?QuestInterface $quest): QuestObjectiveInterface
    {
        $this->quest = $quest;

        return $this;
    }

    public function __toString(): string
    {
        return $this->__get('description');
    }
}
