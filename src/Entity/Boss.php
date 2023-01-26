<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\BossInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\BossRepository;
use App\Traits\SlugTrait;
use App\Traits\UuidPrimaryKeyTrait;
use DateTime;
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

    #[ORM\Column(type: 'json', nullable: true)]
    private array $types = [];

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

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->getPublished();
    }

    public function getPublished(): bool
    {
        return $this->published;
    }

    /**
     * @param bool $published
     * @return BossInterface
     */
    public function setPublished(bool $published): BossInterface
    {
        $this->published = $published;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @param string|null $imageName
     * @return Boss
     */
    public function setImageName(?string $imageName): Boss
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     * @return Boss
     */
    public function setImageFile(?File $imageFile): Boss
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            $this->updatedAt = new DateTime('NOW');
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getTypes(): array
    {
        return array_unique($this->types);
    }

    /**
     * @param array $types
     */
    public function setTypes(array $types): void
    {
        $this->types = $types;
    }
}
