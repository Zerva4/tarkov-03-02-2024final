<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\MapInterface;
use App\Interfaces\QuestInterface;
use App\Repository\LocationRepository;
use App\Traits\SlugTrait;
use App\Traits\TranslatableMagicMethodsTrait;
use App\Traits\UuidPrimaryKeyTrait;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Table(name: 'maps')]
#[ORM\Index(columns: ['slug'], name: 'maps_slug_idx')]
#[ORM\Entity(repositoryClass: LocationRepository::class)]
#[Vich\Uploadable]
/**
 * @Vich\Uploadable
 */
class Map implements MapInterface, TranslatableInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TranslatableTrait;
    use TimestampableTrait;
    use SlugTrait;
    use TranslatableMagicMethodsTrait;

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
     * @Vich\UploadableField(mapping="locations", fileNameProperty="imageName")
     * @Assert\Valid
     * @Assert\File(
     *     maxSize="2M",
     *     mimeTypes={
     *         "image/jpg", "image/gif", "image/jpeg", "image/png"
     *     }
     * )
     */
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    #[Assert\NotBlank]
    private ?string $numberOfPlayers;

    #[ORM\Column(type: 'time', nullable: true)]
    private ?DateTimeInterface $raidDuration;

    #[ORM\OneToMany(mappedBy: 'location', targetEntity: Quest::class, cascade: ['persist'], fetch: 'EXTRA_LAZY')]
    private Collection $quests;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        $this->defaultLocale = $defaultLocation;
    }

    public function isPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): self
    {
        $this->published = $published;

        return $this;
    }

    public function getNumberOfPlayers(): ?string
    {
        return $this->numberOfPlayers;
    }

    public function setNumberOfPlayers(?string $numberOfPlayers): self
    {
        $this->numberOfPlayers = $numberOfPlayers;

        return $this;
    }

    public function getRaidDuration(): ?DateTimeInterface
    {
        return $this->raidDuration;
    }

    public function setRaidDuration(?DateTimeInterface $raidDuration): self
    {
        $this->raidDuration = $raidDuration;

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
     */
    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    /**
     * @return Collection
     */
    public function getQuests(): Collection
    {
        return $this->quests;
    }

    /**
     * @param Collection $quests
     * @return MapInterface
     */
    public function setQuests(Collection $quests): MapInterface
    {
        $this->quests = $quests;

        return $this;
    }

    /**
     * @param QuestInterface ...$quests
     * @return MapInterface
     */
    public function addQuest(QuestInterface ...$quests): MapInterface
    {
        foreach ($quests as $quest) {
            if (!$this->quests->contains($quest)) {
                $this->quests->add($quest);
                $quest->setLocation($this);
            }
        }

        return $this;
    }

    /**
     * @param QuestInterface $quest
     * @return MapInterface
     */
    public function removeQuest(QuestInterface $quest): MapInterface
    {
        if ($this->quests->contains($quest)) {
            $this->quests->removeElement($quest);
            $quest->setLocation(null);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->__get('title');
    }

    /**
     * @return mixed
     */
    public function getImageFile(): mixed
    {
        return $this->imageFile;
    }

    /**
     * @param mixed $imageFile
     * @return MapInterface
     */
    public function setImageFile(mixed $imageFile): MapInterface
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            $this->updatedAt = new DateTime('NOW');
        }

        return $this;
    }
}
