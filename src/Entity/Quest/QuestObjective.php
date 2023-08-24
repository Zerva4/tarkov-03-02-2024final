<?php

declare(strict_types=1);

namespace App\Entity\Quest;

use App\Entity\Map;
use App\Entity\TranslatableEntity;
use App\Interfaces\MapInterface;
use App\Interfaces\Quest\QuestInterface;
use App\Interfaces\Quest\QuestObjectiveInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Quest\QuestObjectiveRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

#[ORM\Table(name: 'quests_objectives')]
#[ORM\Index(columns: ['type'], name: 'quest_objective_type_idx')]
#[ORM\Index(columns: ['api_id'], name: 'quest_objective_api_idx')]
#[ORM\Entity(repositoryClass: QuestObjectiveRepository::class)]
#[ORM\HasLifecycleCallbacks]
class QuestObjective extends TranslatableEntity implements UuidPrimaryKeyInterface, QuestObjectiveInterface
{
    use UuidPrimaryKeyTrait;
    use TranslatableTrait;

    public static array $objectiveTypes = [
        'TYPE_NULL' => 'TYPE_NULL',
        'TYPE_PLANT_ITEM' => 'TYPE_PLANT_ITEM',
        'TYPE_SHOOT' => 'TYPE_SHOOT',
        'TYPE_TRADER_LEVEL' => 'TYPE_TRADER_LEVEL',
        'TYPE_FIND_ITEM' => 'TYPE_FIND_ITEM',
        'TYPE_GIVE_QUEST_ITEM' => 'TYPE_GIVE_QUEST_ITEM',
        'TYPE_PLANT_QUEST_ITEM' => 'TYPE_PLANT_QUEST_ITEM',
        'TYPE_MARK' => 'TYPE_MARK',
        'TYPE_FIND_QUEST_ITEM' => 'TYPE_FIND_QUEST_ITEM',
        'TYPE_GIVE_ITEM' => 'TYPE_GIVE_ITEM',
        'TYPE_PLAYER_LEVEL' => 'TYPE_PLAYER_LEVEL',
        'TYPE_BUILD_WEAPON' => 'TYPE_BUILD_WEAPON',
        'TYPE_EXTRACT' => 'TYPE_EXTRACT',
        'TYPE_TASK_STATUS' => 'TYPE_TASK_STATUS',
        'TYPE_VISIT' => 'TYPE_VISIT',
        'TYPE_SKILL' => 'TYPE_SKILL',
        'TYPE_EXPERIENCE' => 'TYPE_EXPERIENCE',
    ];

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $apiId;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $optional = false;

    private Collection $maps;

    #[ORM\ManyToOne(targetEntity: Quest::class, inversedBy: 'objectives')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?QuestInterface $quest = null;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        parent::__construct($defaultLocation);

        $this->maps = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function getApiId(): ?string
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
     * Get quest instance.
     *
     * @return QuestInterface
     */
    public function getQuest(): QuestInterface
    {
        return $this->quest;
    }

    /**
     * Set quest instance.
     *
     * @param QuestInterface|null $quest
     * @return QuestObjectiveInterface
     */
    public function setQuest(?QuestInterface $quest): QuestObjectiveInterface
    {
        $this->quest = $quest;

        return $this;
    }

    /**
     * Get maps collections.
     *
     * @return Collection<Map>
     */
    public function getMaps(): Collection
    {
        return $this->maps;
    }

    /**
     * Set maps collections.
     *
     * @param Collection<Map> $maps
     * @return QuestObjectiveInterface
     */
    public function setMaps(Collection $maps): QuestObjectiveInterface
    {
        $this->maps = $maps;

        return $this;
    }

    /**
     * @param MapInterface ...$maps
     * @return QuestObjectiveInterface
     */
    public function addMap(MapInterface ...$maps): QuestObjectiveInterface
    {
        foreach ($maps as $map) {
            if (!$this->maps->contains($map)) {
                $this->maps->add($map);
                //$objective->setQuest($this);
            }
        }

        return $this;
    }

    /**
     * @param MapInterface $map
     * @return QuestObjectiveInterface
     */
    public function removeMap(MapInterface $map): QuestObjectiveInterface
    {
        if ($this->maps->contains($map)) {
            $this->maps->removeElement($map);
            //$objective->setQuest(null);
        }

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
