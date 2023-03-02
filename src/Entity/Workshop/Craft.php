<?php

namespace App\Entity\Workshop;

use App\Repository\Workshop\CraftRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CraftRepository::class)]
class Craft
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
