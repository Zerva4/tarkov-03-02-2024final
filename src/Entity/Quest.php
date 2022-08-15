<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\MapInterface;
use App\Interfaces\QuestInterface;
use App\Interfaces\QuestObjectiveInterface;
use App\Interfaces\TraderInterface;
use App\Repository\QuestRepository;
use App\Traits\SlugTrait;
use App\Traits\UuidPrimaryKeyTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Table(name: 'Quests')]
#[ORM\Index(columns: ['slug'], name: 'quests_slug_idx')]
#[ORM\Index(columns: ['api_id'], name: 'quests_api_key_idx')]
#[ORM\Entity(repositoryClass: QuestRepository::class)]
#[Vich\Uploadable]
/**
 * @Vich\Uploadable
 */
class Quest extends BaseEntity implements QuestInterface, TranslatableInterface
{
    use UuidPrimaryKeyTrait;
    use SlugTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $apiId;

    #[ORM\Column(type: 'boolean')]
    private bool $published;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $experience = null;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $minPlayerLevel = 1;

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

    #[ORM\OneToMany(mappedBy: 'quest', targetEntity: QuestObjective::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    private Collection $objectives;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        parent::__construct($defaultLocation);
        $this->objectives = new ArrayCollection();
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

    /**
     * @return Collection
     */
    public function getObjectives(): Collection
    {
        return $this->objectives;
    }

    /**
     * @param Collection $objectives
     * @return QuestInterface
     */
    public function setObjectives(Collection $objectives): QuestInterface
    {
        $this->objectives = $objectives;

        return $this;
    }

    /**
     * @param QuestObjectiveInterface ...$objectives
     * @return QuestInterface
     */
    public function addObjective(QuestObjectiveInterface ...$objectives): QuestInterface
    {
        foreach ($objectives as $objective) {
            if (!$this->objectives->contains($objective)) {
                $this->objectives->add($objective);
                $objective->setQuest($this);
            }
        }

        return $this;
    }

    /**
     * @param QuestObjectiveInterface $objective
     * @return QuestInterface
     */
    public function removeObjective(QuestObjectiveInterface $objective): QuestInterface
    {
        if ($this->objectives->contains($objective)) {
            $this->objectives->removeElement($objective);
            $objective->setQuest(null);
        }

        return $this;
    }

    /**
     * @return int|null
     */
    public function getExperience(): ?int
    {
        return $this->experience;
    }

    /**
     * @param int|null $experience
     * @return QuestInterface
     */
    public function setExperience(?int $experience): QuestInterface
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * @return int
     */
    public function getMinPlayerLevel(): int
    {
        return $this->minPlayerLevel;
    }

    /**
     * @param int $minPlayerLevel
     * @return QuestInterface
     */
    public function setMinPlayerLevel(int $minPlayerLevel): QuestInterface
    {
        $this->minPlayerLevel = $minPlayerLevel;

        return $this;
    }

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
    public function setApiId(string $apiId): QuestInterface
    {
        $this->apiId = $apiId;

        return $this;
    }
}
