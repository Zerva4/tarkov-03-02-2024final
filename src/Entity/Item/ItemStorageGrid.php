<?php

declare(strict_types=1);

namespace App\Entity\Item;

use App\Entity\Item\Properties\ItemProperties;
use App\Interfaces\Item\ItemStorageGridInterface;
use App\Interfaces\Item\Properties\ItemPropertiesInterface;
use App\Repository\Item\ItemStorageGridRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_storage_grids', options: ['comment' => 'Таблица свойств для брони'])]
#[ORM\Entity(repositoryClass: ItemStorageGridRepository::class)]
class ItemStorageGrid implements ItemStorageGridInterface
{
    use UuidPrimaryKeyTrait;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $width = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $height = null;

    // todo: ItemFilters

    #[ORM\OneToMany(mappedBy: 'grids', targetEntity: ItemProperties::class, fetch: 'EAGER')]
    private Collection $properties;

    public function __construct()
    {
        $this->properties = new ArrayCollection();
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): ItemStorageGridInterface
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): ItemStorageGridInterface
    {
        $this->height = $height;

        return $this;
    }

    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function setProperties(Collection $properties): ItemStorageGridInterface
    {
        $this->properties = $properties;

        return $this;
    }

    public function addProperties(ItemPropertiesInterface $properties): ItemStorageGridInterface
    {
        if (!$this->properties->contains($properties)) {
            $this->properties->add($properties);
            $properties->setGrids($this);
        }

        return $this;
    }

    public function removeProperties(ItemPropertiesInterface $properties): ItemStorageGridInterface
    {
        if ($this->properties->contains($properties)) {
            $this->properties->removeElement($properties);
            $properties->setGrids(null);
        }

        return $this;
    }
}
