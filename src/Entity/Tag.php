<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\TagInterface;
use App\Repository\TagRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'Tags')]
#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag implements TagInterface
{
    use UuidPrimaryKeyTrait;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): TagInterface
    {
        $this->name = $name;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
