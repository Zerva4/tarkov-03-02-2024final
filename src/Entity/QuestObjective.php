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
#[ORM\Index(columns: ['type'], name: 'quest_objective_type_idx')]
#[ORM\Index(columns: ['api_id'], name: 'quest_objective_api_idx')]
#[ORM\Entity(repositoryClass: QuestObjectiveRepository::class)]
#[ORM\HasLifecycleCallbacks]
class QuestObjective extends BaseEntity implements QuestObjectiveInterface
{
    use UuidPrimaryKeyTrait;
    use TranslatableTrait;

    public static array $objectiveTypes = [
        null => 'TYPE_NULL',
        'plantItem' => 'TYPE_PLANT_ITEM',
        'shoot' => 'TYPE_SHOOT',
        'traderLevel' => 'TYPE_TRADER_LEVEL',
        'findItem' => 'TYPE_FIND_ITEM',
        'giveQuestItem' => 'TYPE_GIVE_QUEST_ITEM',
        'plantQuestItem' => 'TYPE_PLANT_QUEST_ITEM',
        'mark' => 'TYPE_MARK',
        'findQuestItem' => 'TYPE_FIND_QUEST_ITEM',
        'giveItem' => 'TYPE_GIVE_ITEM',
        'playerLevel' => 'TYPE_PLAYER_LEVEL',
        'buildWeapon' => 'TYPE_BUILD_WEAPON',
        'extract' => 'TYPE_EXTRACT',
        'taskStatus' => 'TYPE_TASK_STATUS',
        'visit' => 'TYPE_VISIT',
        'skill' => 'TYPE_SKILL',
        'experience' => 'TYPE_EXPERIENCE',
    ];

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $apiId;

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

    /**
     * @return string
     */
    public function getApiId(): string
    {
        return $this->apiId;
    }

    /**
     * @param string $apiId
     * @return QuestObjectiveInterface
     */
    public function setApiId(string $apiId): QuestObjectiveInterface
    {
        $this->apiId = $apiId;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->__get('description');
    }
}
