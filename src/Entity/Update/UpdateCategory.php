<?php

declare(strict_types=1);

namespace App\Entity\Update;

use App\Entity\TranslatableEntity;
use App\Interfaces\Update\UpdateCategoryInterface;
use App\Interfaces\Update\UpdateInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Update\UpdateCategoryRepository;
use App\Traits\SlugTrait;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Table(name: 'updates_category')]
#[ORM\Index(columns: ['slug'], name: 'updates_category_slug_idx')]
#[ORM\Entity(repositoryClass: UpdateCategoryRepository::class)]
class UpdateCategory extends TranslatableEntity implements UpdateCategoryInterface, UuidPrimaryKeyInterface, TranslatableInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;
    use SlugTrait;

    #[ORM\Column(type: 'boolean')]
    private bool $published;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Update::class, cascade: ['persist'], fetch: 'EXTRA_LAZY')]
    private Collection $updates;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        parent::__construct($defaultLocation);

        $this->updates  = new ArrayCollection();
    }

    public function isPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): UpdateCategoryInterface
    {
        $this->published = $published;

        return $this;
    }

    public function getUpdates(): Collection
    {
        return $this->updates;
    }

    public function setUpdates(Collection $updates): UpdateCategoryInterface
    {
        $this->updates = $updates;

        return $this;
    }

    public function addUpdate(UpdateInterface $update): UpdateCategoryInterface
    {
        if (!$this->updates->contains($update)) {
            $this->updates->add($update);
            $update->setCategory($this);
        }

        return $this;
    }

    public function removeUpdate(UpdateInterface $update): UpdateCategoryInterface
    {
        if ($this->updates->contains($update)) {
            $this->updates->removeElement($update);
            $update->setCategory(null);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
