<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\QuestObjectiveInterface;
use App\Repository\QuestObjectiveRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'quests_objectives')]
#[ORM\Entity(repositoryClass: QuestObjectiveRepository::class)]
class QuestObjective extends BaseEntity implements QuestObjectiveInterface
{
    use UuidPrimaryKeyTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $optional = false;

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function isOptional(): bool
    {
        return $this->optional;
    }

    /**
     * @param bool $optional
     */
    public function setOptional(bool $optional): void
    {
        $this->optional = $optional;
    }
}
