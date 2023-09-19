<?php

declare(strict_types=1);

namespace App\Entity\Item;

use App\Entity\TranslatableEntity;
use App\Interfaces\Item\ItemCaliberInterface;
use App\Interfaces\Item\ItemPropertiesInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Item\ItemCaliberRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;

#[ORM\Table(name: 'items_calibers')]
#[ORM\Index(columns: ['slug'], name: 'items_calibers_slug_idx')]
#[ORM\Index(columns: ['api_id'], name: 'items_calibers_api_key_idx')]
#[ORM\Entity(repositoryClass: ItemCaliberRepository::class)]
class ItemCaliber extends TranslatableEntity implements UuidPrimaryKeyInterface, ItemCaliberInterface, TranslatableInterface
{
    use UuidPrimaryKeyTrait;

    #[ORM\Column(type: 'boolean')]
    private bool $published;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $apiId;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $slug;

    #[ORM\OneToMany(mappedBy: 'caliber', targetEntity: ItemProperties::class, fetch: 'EAGER')]
    private Collection $properties;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        parent::__construct($defaultLocation);

        $this->properties = new ArrayCollection();
    }

    public function isPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): ItemCaliberInterface
    {
        $this->published = $published;

        return $this;
    }

    public function getApiId(): string
    {
        return $this->apiId;
    }

    public function setApiId(string $apiId): ItemCaliberInterface
    {
        $this->apiId = $apiId;

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): ItemCaliberInterface
    {
        $this->slug = $slug;

        return $this;
    }

    public function getName(): string
    {
        return $this->translate()->getName();
    }

    public function setName(string $name): ItemCaliberInterface
    {
        $this->translate()->setName($name);

        return $this;
    }

    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function setProperties(Collection $properties): ItemCaliberInterface
    {
        $this->properties = $properties;

        return $this;
    }

    public function addProperties(ItemPropertiesInterface $properties): ItemCaliberInterface
    {
        if (!$this->properties->contains($properties)) {
            $this->properties->add($properties);
            $properties->setCaliber($this);
        }

        return $this;
    }

    public function removeProperties(ItemPropertiesInterface $properties): ItemCaliberInterface
    {
        if ($this->properties->contains($properties)) {
            $this->properties->removeElement($properties);
            $properties->setCaliber(null);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
