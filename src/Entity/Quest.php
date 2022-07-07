<?php

namespace App\Entity;

use App\Repository\QuestRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestRepository::class)]
class Quest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title;

    #[ORM\Column(type: 'text')]
    private ?string $description;

    #[ORM\Column(type: 'text')]
    private ?string $howToComplete;

    public function getId(): ?int
    {
        return $this->id;
    }

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
