<?php

declare(strict_types=1);

namespace App\Entity\Item;

use App\Entity\Item\Properties\ItemProperties;
use App\Entity\TranslatableEntity;
use App\Interfaces\Item\ItemMaterialInterface;
use App\Interfaces\Item\Properties\ItemPropertiesInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Item\ItemMaterialRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

#[ORM\Table(name: 'items_materials', options: ['comment' => 'Таблица материалов для предметов'])]
#[ORM\Index(columns: ['api_id'], name: 'items_materials_api_key_idx')]
#[ORM\Entity(repositoryClass: ItemMaterialRepository::class)]
class ItemMaterial extends TranslatableEntity implements ItemMaterialInterface, UuidPrimaryKeyInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TranslatableTrait;

    #[ORM\Column(type: 'string', length: 32, unique: true, nullable: false, options: ['default' => '', 'comment' => 'Идентификатор API'])]
    private string $apiId;

    #[ORM\Column(type: 'boolean')]
    private bool $published;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0.0, 'comment' => 'Разрушаемость'])]
    private float $destructibility;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0.0, 'comment' => 'Мин. деградация при ремонте'])]
    private float $minRepairDegradation;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0.0, 'comment' => 'Макс. деградация при ремонте'])]
    private float $maxRepairDegradation;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0.0, 'comment' => 'Разрущаемость от взрыва'])]
    private float $explosionDestructibility;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0.0, 'comment' => 'Мин. деградация ремкомплектапри ремонте'])]
    private float $minRepairKitDegradation;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0.0, 'comment' => 'Макс. деградация ремкомплектапри ремонте'])]
    private float $maxRepairKitDegradation;

    #[ORM\OneToMany(mappedBy: 'material', targetEntity: ItemProperties::class, fetch: 'EAGER')]
    private Collection $properties;

    public function __construct(string $defaultLocale = '%app.default_locale%')
    {
        parent::__construct($defaultLocale);

        $this->properties = new ArrayCollection();
    }

    public function getApiId(): string
    {
        return $this->apiId;
    }

    public function setApiId(string $apiId): ItemMaterialInterface
    {
        $this->apiId = $apiId;

        return $this;
    }

    public function isPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): ItemMaterialInterface
    {
        $this->published = $published;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->translate()->getName();
    }

    public function setName(string $name): ItemMaterialInterface
    {
        $this->translate()->setName($name);

        return $this;
    }

    public function getDestructibility(): float
    {
        return $this->destructibility;
    }

    public function setDestructibility(float $destructibility): ItemMaterialInterface
    {
        $this->destructibility = $destructibility;

        return $this;
    }

    public function getMinRepairDegradation(): float
    {
        return $this->minRepairDegradation;
    }

    public function setMinRepairDegradation(float $minRepairDegradation): ItemMaterialInterface
    {
        $this->minRepairDegradation = $minRepairDegradation;

        return $this;
    }

    public function getMaxRepairDegradation(): float
    {
        return $this->maxRepairDegradation;
    }

    public function setMaxRepairDegradation(float $maxRepairDegradation): ItemMaterialInterface
    {
        $this->maxRepairDegradation = $maxRepairDegradation;

        return $this;
    }

    public function getExplosionDestructibility(): float
    {
        return $this->explosionDestructibility;
    }

    public function setExplosionDestructibility(float $explosionDestructibility): ItemMaterialInterface
    {
        $this->explosionDestructibility = $explosionDestructibility;

        return $this;
    }

    public function getMinRepairKitDegradation(): float
    {
        return $this->minRepairKitDegradation;
    }

    public function setMinRepairKitDegradation(float $minRepairKitDegradation): ItemMaterialInterface
    {
        $this->minRepairKitDegradation = $minRepairKitDegradation;

        return $this;
    }

    public function getMaxRepairKitDegradation(): float
    {
        return $this->maxRepairKitDegradation;
    }

    public function setMaxRepairKitDegradation(float $maxRepairKitDegradation): ItemMaterialInterface
    {
        $this->maxRepairKitDegradation = $maxRepairKitDegradation;

        return $this;
    }

    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function setProperties(Collection $properties): ItemMaterialInterface
    {
        $this->properties = $properties;

        return $this;
    }

    public function addProperties(ItemPropertiesInterface $properties): ItemMaterialInterface
    {
        if (!$this->properties->contains($properties)) {
            $this->properties->add($properties);
            $properties->setMaterial($this);
        }

        return $this;
    }

    public function removeProperties(ItemPropertiesInterface $properties): ItemMaterialInterface
    {
        if ($this->properties->contains($properties)) {
            $this->properties->removeElement($properties);
            $properties->setMaterial(null);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
