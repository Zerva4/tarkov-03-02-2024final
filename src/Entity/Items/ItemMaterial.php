<?php

namespace App\Entity;

use App\Interfaces\ItemMaterialInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\ItemMaterialRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Table(name: 'items_materials')]
#[ORM\Index(columns: ['api_id'], name: 'items_materials_api_key_idx')]
#[ORM\Entity(repositoryClass: ItemMaterialRepository::class)]
class ItemMaterial extends TranslatableEntity implements UuidPrimaryKeyInterface, TimestampableInterface, ItemMaterialInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;

    #[ORM\Column(type: 'boolean')]
    private bool $published;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $apiId = null;

    #[ORM\Column]
    private ?float $destructibility = null;

    #[ORM\Column]
    private ?float $minRepairDegradation = null;

    #[ORM\Column]
    private ?float $maxRepairDegradation = null;

    #[ORM\Column]
    private ?float $explosionDestructibility = null;

    #[ORM\Column]
    private ?float $minRepairKitDegradation = null;

    #[ORM\Column]
    private ?float $maxRepairKitDegradation = null;

    public function isPublished(): bool
    {
        return $this->getPublished();
    }

    public function getPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): self
    {
        $this->published = $published;

        return $this;
    }

    public function getApiId(): ?string
    {
        return $this->apiId;
    }

    public function setApiId(?string $apiId): self
    {
        $this->apiId = $apiId;

        return $this;
    }

    public function getDestructibility(): ?float
    {
        return $this->destructibility;
    }

    public function setDestructibility(float $destructibility): self
    {
        $this->destructibility = $destructibility;

        return $this;
    }

    public function getMinRepairDegradation(): ?float
    {
        return $this->minRepairDegradation;
    }

    public function setMinRepairDegradation(float $minRepairDegradation): self
    {
        $this->minRepairDegradation = $minRepairDegradation;

        return $this;
    }

    public function getMaxRepairDegradation(): ?float
    {
        return $this->maxRepairDegradation;
    }

    public function setMaxRepairDegradation(float $maxRepairDegradation): self
    {
        $this->maxRepairDegradation = $maxRepairDegradation;

        return $this;
    }

    public function getExplosionDestructibility(): ?float
    {
        return $this->explosionDestructibility;
    }

    public function setExplosionDestructibility(float $explosionDestructibility): self
    {
        $this->explosionDestructibility = $explosionDestructibility;

        return $this;
    }

    public function getMinRepairKitDegradation(): ?float
    {
        return $this->minRepairKitDegradation;
    }

    public function setMinRepairKitDegradation(float $minRepairKitDegradation): self
    {
        $this->minRepairKitDegradation = $minRepairKitDegradation;

        return $this;
    }

    public function getMaxRepairKitDegradation(): ?float
    {
        return $this->maxRepairKitDegradation;
    }

    public function setMaxRepairKitDegradation(float $maxRepairKitDegradation): self
    {
        $this->maxRepairKitDegradation = $maxRepairKitDegradation;

        return $this;
    }
}
