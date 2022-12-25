<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Quests\Quest;
use App\Interfaces\MapInterface;
use App\Interfaces\MapLocationInterface;
use App\Interfaces\QuestInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\MapRepository;
use App\Traits\SlugTrait;
use App\Traits\UuidPrimaryKeyTrait;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Table(name: 'maps')]
#[ORM\Index(columns: ['slug'], name: 'maps_slug_idx')]
#[ORM\Entity(repositoryClass: MapRepository::class)]
#[Vich\Uploadable]
/**
 * @Vich\Uploadable
 */
class Map extends TranslatableEntity implements UuidPrimaryKeyInterface, MapInterface, TranslatableInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;
    use SlugTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $apiId;

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

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0])]
    private int $minPlayersNumber = 0;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0])]
    private int $maxPlayersNumber = 0;

    #[ORM\Column(type: 'time', nullable: true)]
    private ?DateTimeInterface $raidDuration;

    #[ORM\OneToMany(mappedBy: 'map', targetEntity: Quest::class, cascade: ['persist'], fetch: 'EXTRA_LAZY')]
    private Collection $quests;

    #[ORM\OneToMany(mappedBy: 'map', targetEntity: MapLocation::class, cascade: ['persist'], fetch: 'EXTRA_LAZY')]
    private Collection $locations;

    // TODO: Добавить врагов и босссов.
    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        parent::__construct($defaultLocation);

        $this->quests = new ArrayCollection();
    }

    public function isPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): MapInterface
    {
        $this->published = $published;

        return $this;
    }

    public function getApiId(): string
    {
        return $this->apiId;
    }

    public function setApiId(string $apiId): MapInterface
    {
        $this->apiId = $apiId;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): MapInterface
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getImageFile(): mixed
    {
        return $this->imageFile;
    }

    public function setImageFile(mixed $imageFile): MapInterface
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            $this->updatedAt = new DateTime('NOW');
        }

        return $this;
    }

    public function getMinPlayersNumber(): int
    {
        return $this->minPlayersNumber;
    }

    public function setMinPlayersNumber(int $minPlayersNumber): MapInterface
    {
        $this->minPlayersNumber = $minPlayersNumber;

        return $this;
    }

    public function getMaxPlayersNumber(): int
    {
        return $this->maxPlayersNumber;
    }

    public function setMaxPlayersNumber(int $maxPlayersNumber): MapInterface
    {
        $this->maxPlayersNumber = $maxPlayersNumber;

        return $this;
    }

    public function getRaidDuration(): ?DateTimeInterface
    {
        return $this->raidDuration;
    }

    public function setRaidDuration(?DateTimeInterface $raidDuration): MapInterface
    {
        $this->raidDuration = $raidDuration;

        return $this;
    }

    public function getQuests(): Collection
    {
        return $this->quests;
    }

    public function setQuests(Collection $quests): MapInterface
    {
        $this->quests = $quests;

        return $this;
    }

    public function addQuest(QuestInterface $quest): MapInterface
    {
        if (!$this->quests->contains($quest)) {
            $this->quests->add($quest);
            $quest->setMap($this);
        }

        return $this;
    }

    public function removeQuest(QuestInterface $quest): MapInterface
    {
        if ($this->quests->contains($quest)) {
            $this->quests->removeElement($quest);
            $quest->setMap(null);
        }

        return $this;
    }

    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function setLocations(Collection $locations): MapInterface
    {
        $this->locations = $locations;

        return $this;
    }

    public function addLocation(MapLocationInterface $location): MapInterface
    {
        if (!$this->locations->contains($location)) {
            $this->locations->add($location);
            $location->setMap($this);
        }

        return $this;
    }

    public function removeLocation(MapLocationInterface $location): MapInterface
    {
        if ($this->locations->contains($location)) {
            $this->locations->removeElement($location);
            $location->setMap(null);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->__get('title');
    }
}
