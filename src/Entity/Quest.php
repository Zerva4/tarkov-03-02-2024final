<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\QuestRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'Quests')]
#[ORM\Entity(repositoryClass: QuestRepository::class)]
class Quest
{
    use UuidPrimaryKeyTrait;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title;

    #[ORM\Column(type: 'text')]
    private ?string $description;

    #[ORM\Column(type: 'text')]
    private ?string $howToComplete;

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
}
