<?php

namespace App\Entity\Update;

use App\Entity\TranslatableEntity;
use App\Interfaces\Update\UpdateCategoryInterface;
use App\Interfaces\Update\UpdateInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Update\UpdateRepository;
use App\Traits\SlugTrait;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Table(name: 'updates')]
#[ORM\Entity(repositoryClass: UpdateRepository::class)]
class Update  extends TranslatableEntity implements UpdateInterface, UuidPrimaryKeyInterface, TranslatableInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;

    #[ORM\ManyToOne(targetEntity: UpdateCategory::class, cascade: ['persist'], inversedBy: 'updates')]
    #[ORM\JoinColumn(referencedColumnName: 'id', onDelete: 'SET NULL')]
    private ?UpdateCategoryInterface $category;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        parent::__construct($defaultLocation);
    }

    public function getCategory(): ?UpdateCategoryInterface
    {
        return $this->category;
    }

    public function setCategory(?UpdateCategoryInterface $category): UpdateInterface
    {
        $this->category = $category;

        return $this;
    }
}
