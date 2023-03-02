<?php

namespace App\Entity\Workshop;

use App\Entity\TranslatableEntity;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Interfaces\Workshop\PlaceInterface;
use App\Repository\Workshop\PlaceRepository;
use App\Traits\SlugTrait;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Table(name: 'places')]
#[ORM\Index(columns: ['slug'], name: 'place_slug_idx')]
#[ORM\Index(columns: ['api_id'], name: 'place_api_id_idx')]
#[ORM\Entity(repositoryClass: PlaceRepository::class)]
class Place extends TranslatableEntity implements UuidPrimaryKeyInterface, TranslatableInterface, TimestampableInterface, PlaceInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;
    use SlugTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $apiId = null;

    #[ORM\Column(type: 'boolean', nullable: false, options: ['default' => true])]
    private bool $published = true;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0])]
    private int $order = 0;

    #[ORM\OneToMany(mappedBy: 'trader', targetEntity: PlaceLevel::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    #[ORM\OrderBy(['level' => 'ASC'])]
    private Collection $levels;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        parent::__construct($defaultLocation);

        $this->levels = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function getApiId(): ?string
    {
        return $this->apiId;
    }

    /**
     * @param string $apiId
     * @return PlaceInterface
     */
    public function setApiId(string $apiId): PlaceInterface
    {
        $this->apiId = $apiId;

        return $this;
    }

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->published;
    }

    /**
     * @param bool $published
     * @return PlaceInterface
     */
    public function setPublished(bool $published): PlaceInterface
    {
        $this->published = $published;

        return $this;
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @param int $order
     * @return PlaceInterface
     */
    public function setOrder(int $order): PlaceInterface
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getLevels(): Collection
    {
        return $this->levels;
    }

    /**
     * @param Collection $levels
     * @return PlaceInterface
     */
    public function setLevels(Collection $levels): PlaceInterface
    {
        $this->levels = $levels;

        return $this;
    }
}
