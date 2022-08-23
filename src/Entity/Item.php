<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use App\Traits\SlugTrait;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items')]
#[ORM\Index(columns: ['slug'], name: 'item_slug_idx')]
#[ORM\Index(columns: ['api_id'], name: 'item_api_key_idx')]
#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item extends BaseEntity
{
    use UuidPrimaryKeyTrait;
    use SlugTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $apiId;

    /**
     * @return string
     */
    public function getApiId(): string
    {
        return $this->apiId;
    }

    /**
     * @param string $apiId
     */
    public function setApiId(string $apiId): void
    {
        $this->apiId = $apiId;
    }
}
