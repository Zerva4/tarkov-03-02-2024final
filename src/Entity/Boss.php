<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\BossHealthInterface;
use App\Interfaces\BossInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\BossRepository;
use App\Traits\SlugTrait;
use App\Traits\UuidPrimaryKeyTrait;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Table(name: 'bosses')]
#[ORM\Entity(repositoryClass: BossRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
/**
 * @Vich\Uploadable
 */
class Boss extends TranslatableEntity implements UuidPrimaryKeyInterface, TranslatableInterface, TimestampableInterface, BossInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;
    use SlugTrait;

    #[ORM\Column(type: 'boolean')]
    private bool $published;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $imageName = null;

    #[Vich\UploadableField(mapping: 'locations', fileNameProperty: 'imageName')]
    #[Assert\Valid]
    #[Assert\File(
        maxSize: '2M',
        mimeTypes: ['image/jpg', 'image/gif', 'image/jpeg', 'image/png']
    )]
    /**
     * @Vich\UploadableField(mapping="traders", fileNameProperty="imageName")
     * @Assert\Valid
     * @Assert\File(
     *     maxSize="2M",
     *     mimeTypes={
     *         "image/webp", "image/jpg", "image/gif", "image/jpeg", "image/png"
     *     }
     * )
     */
    private ?File $imageFile = null;

    private Collection $equipment;

    #[ORM\OneToMany(mappedBy: 'boss', targetEntity: BossHealth::class, cascade: ['persist'], fetch: 'EXTRA_LAZY')]
    private Collection $health;

    public function isPublished(): bool
    {
        return $this->getPublished();
    }

    public function getPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): BossInterface
    {
        $this->published = $published;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): Boss
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile): Boss
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            $this->updatedAt = new DateTime('NOW');
        }

        return $this;
    }

    public function getEquipment(): Collection
    {
        return $this->equipment;
    }

    /**
     * @param Collection $equipment
     * @return BossInterface
     */
    public function setEquipment(Collection $equipment): BossInterface
    {
        $this->equipment = $equipment;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getHealth(): Collection
    {
        return $this->health;
    }

    public function setHealth(Collection $health): BossInterface
    {
        $this->health = $health;

        return $this;
    }

    public function addHealth(BossHealthInterface $health): BossInterface
    {
        if (!$this->health->contains($health)) {
            $this->health->add($health);
            $health->setMap($this);
        }

        return $this;
    }

    public function removeHealth(BossHealthInterface $health): BossInterface
    {
        if ($this->health->contains($health)) {
            $this->health->removeElement($health);
            $health->setMap(null);
        }

        return $this;
    }
}
