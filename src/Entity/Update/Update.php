<?php

namespace App\Entity\Update;

use App\Entity\TranslatableEntity;
use App\Interfaces\Update\UpdateCategoryInterface;
use App\Interfaces\Update\UpdateInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Update\UpdateRepository;
use App\Traits\SlugTrait;
use App\Traits\UuidPrimaryKeyTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Table(name: 'updates')]
#[ORM\Index(columns: ['date_added'], name: 'updates_date_added_idx')]
#[ORM\Index(columns: ['date_added2'], name: 'updates_date_added2_idx')]
#[ORM\Index(columns: ['slug'], name: 'updates_slug_idx')]
#[ORM\Entity(repositoryClass: UpdateRepository::class)]
class Update  extends TranslatableEntity implements UpdateInterface, UuidPrimaryKeyInterface, TranslatableInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;
    use SlugTrait;

    #[ORM\Column(type: 'boolean', nullable: false, options: ["default" => true])]
    private bool $published = true;

    #[ORM\Column(type: 'datetime', nullable: false, options: ["default" => "CURRENT_TIMESTAMP"])]
    private DateTime $dateAdded;

    #[ORM\Column(type: 'datetime', nullable: true, options: ["default" => null])]
    private ?DateTime $dateAdded2;

    #[ORM\ManyToOne(targetEntity: UpdateCategory::class, cascade: ['persist'], inversedBy: 'updates')]
    #[ORM\JoinColumn(referencedColumnName: 'id', onDelete: 'SET NULL')]
    private ?UpdateCategoryInterface $category;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        parent::__construct($defaultLocation);
    }

    public function isPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): UpdateInterface
    {
        $this->published = $published;

        return $this;
    }

    public function getDateAdded(): DateTime
    {
        return $this->dateAdded;
    }

    public function setDateAdded(DateTime $dateAdded): UpdateInterface
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    public function getDateAdded2(): ?DateTime
    {
        return $this->dateAdded;
    }

    public function setDateAdded2(?DateTime $dateAdded): UpdateInterface
    {
        $this->dateAdded2 = $dateAdded;

        return $this;
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
