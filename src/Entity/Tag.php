<?php

namespace App\Entity;

use App\Interfaces\TagInterface;
use App\Repository\TagRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'Tags')]
#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag implements TagInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): TagInterface
    {
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): TagInterface
    {
        $this->name = $name;

        return $this;
    }
}
