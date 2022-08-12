<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\MapInterface;
use App\Interfaces\QuestInterface;
use App\Interfaces\TraderInterface;
use App\Repository\QuestRepository;
use App\Traits\SlugTrait;
use App\Traits\TranslatableMagicMethodsTrait;
use App\Traits\UuidPrimaryKeyTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Table(name: 'Quests')]
#[ORM\Index(columns: ['slug'], name: 'quests_slug_idx')]
#[ORM\Entity(repositoryClass: QuestRepository::class)]
#[Vich\Uploadable]
/**
 * @Vich\Uploadable
 */
class Quest implements QuestInterface, TranslatableInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;
    use SlugTrait;
    use TranslatableTrait;
    use TranslatableMagicMethodsTrait;

    #[ORM\Column(type: 'boolean')]
    private bool $published;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $imageName;

    #[Vich\UploadableField(mapping: 'locations', fileNameProperty: 'imageName')]
    #[Assert\Valid]
    #[Assert\File(
        maxSize: '2M',
        mimeTypes: ['image/jpg', 'image/gif', 'image/jpeg', 'image/png']
    )]
    /**
     * @Vich\UploadableField(mapping="quests", fileNameProperty="imageName")
     * @Assert\Valid
     * @Assert\File(
     *     maxSize="2M",
     *     mimeTypes={
     *         "image/jpg", "image/gif", "image/jpeg", "image/png"
     *     }
     * )
     */
    private ?File $imageFile = null;

    #[ORM\ManyToOne(targetEntity: Trader::class, inversedBy: 'quests')]
    private ?TraderInterface $trader = null;

    #[ORM\ManyToOne(targetEntity: Map::class, inversedBy: 'quests')]
    private ?MapInterface $map = null;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        $this->defaultLocale = $defaultLocation;
    }

    public function isPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): QuestInterface
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
     * @return QuestInterface
     */
    public function setImageName(?string $imageName): QuestInterface
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return TraderInterface|null
     */
    public function getTrader(): ?TraderInterface
    {
        return $this->trader;
    }

    /**
     * @param TraderInterface|null $trader
     * @return QuestInterface
     */
    public function setTrader(?TraderInterface $trader): QuestInterface
    {
        $this->trader = $trader;

        return $this;
    }

    /**
     * @return MapInterface|null
     */
    public function getMap(): ?MapInterface
    {
        return $this->map;
    }

    /**
     * @param MapInterface|null $map
     * @return QuestInterface
     */
    public function setMap(?MapInterface $map): QuestInterface
    {
        $this->map = $map;

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
     * @return QuestInterface
     */
    public function setImageFile(?File $imageFile): QuestInterface
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            $this->updatedAt = new DateTime('NOW');
        }

        return $this;
    }
}
