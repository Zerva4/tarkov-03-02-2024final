<?php

declare(strict_types=1);

namespace App\Entity\Item\Properties;

use App\Interfaces\Item\Properties\ItemPropertiesContainerInterface;
use App\Interfaces\Item\Properties\ItemPropertiesInterface;
use App\Repository\Item\Properties\ItemPropertiesContainerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_container', options: ['comment' => 'Таблица свойств для контейнера'])]
#[ORM\Entity(repositoryClass: ItemPropertiesContainerRepository::class)]
class ItemPropertiesContainer extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesContainerInterface
{
    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Емкость'])]
    private int $capacity;

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): ItemPropertiesContainerInterface
    {
        $this->capacity = $capacity;

        return $this;
    }
}
