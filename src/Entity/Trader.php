<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\QuestInterface;
use App\Interfaces\TraderInterface;
use App\Interfaces\TraderLevelInterface;
use App\Repository\TraderRepository;
use App\Traits\SlugTrait;
use App\Traits\TranslatableMagicMethodsTrait;
use App\Traits\UuidPrimaryKeyTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Table(name: 'traders')]
#[ORM\Index(columns: ['api_id'], name: 'traders_api_key_idx')]
#[ORM\Entity(repositoryClass: TraderRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
/**
 * @Vich\Uploadable
 */
class Trader implements TraderInterface, TranslatableInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;
    use SlugTrait;
    use TranslatableTrait;
    use TranslatableMagicMethodsTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $apiId;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0])]
    private int $position;

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
     * @Vich\UploadableField(mapping="traders", fileNameProperty="imageName")
     * @Assert\Valid
     * @Assert\File(
     *     maxSize="2M",
     *     mimeTypes={
     *         "image/jpg", "image/gif", "image/jpeg", "image/png"
     *     }
     * )
     */
    private ?File $imageFile = null;

    #[ORM\OneToMany(mappedBy: 'trader', targetEntity: TraderLevel::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    #[ORM\OrderBy(['level' => 'ASC'])]
    private Collection $levels;

    #[ORM\OneToMany(mappedBy: 'trader', targetEntity: Quest::class, cascade: ['persist'], fetch: 'EXTRA_LAZY')]
    private Collection $quests;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        $this->defaultLocale = $defaultLocation;
        $this->levels = new ArrayCollection();
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
     * @return TraderInterface
     */
    public function setImageFile(?File $imageFile): TraderInterface
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            $this->updatedAt = new DateTime('NOW');
        }

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
     * @return TraderInterface
     */
    public function setApiId(string $apiId): TraderInterface
    {
        $this->apiId = $apiId;

        return $this;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    protected function proxyCurrentLocaleTranslation(string $method, array $arguments = [])
    {
        if (! method_exists(self::getTranslationEntityClass(), $method)) {
            $method = 'get' . ucfirst($method);
        }

        $translation = $this->translate($this->getCurrentLocale());

        return (method_exists(self::getTranslationEntityClass(), $method)) ? call_user_func_array([$translation, $method], $arguments) : null;
    }

    public function isPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): TraderInterface
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
     * @return Trader
     */
    public function setImageName(?string $imageName): TraderInterface
    {
        $this->imageName = $imageName;

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
     * @param Collection $level
     * @return TraderInterface
     */
    public function setLevels(Collection $level): TraderInterface
    {
        $this->levels = $level;

        return $this;
    }

    /**
     * @param TraderLevelInterface ...$levels
     * @return Trader
     */
    public function addLevel(TraderLevelInterface ...$levels): TraderInterface
    {
        foreach ($levels as $level) {
            if (!$this->levels->contains($level)) {
                $this->levels->add($level);
                $level->setTrader($this);
            }
        }

        return $this;
    }

    /**
     * @param TraderLevelInterface $level
     * @return TraderInterface
     */
    public function removeLevel(TraderLevelInterface $level): TraderInterface
    {
        if ($this->levels->contains($level)) {
            $this->levels->removeElement($level);
        }

        return $this;
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
     */
    public function setQuests(Collection $quests): TraderInterface
    {
        $this->quests = $quests;

        return $this;
    }

    /**
     * @param QuestInterface ...$quests
     * @return Trader
     */
    public function addQuest(QuestInterface ...$quests): TraderInterface
    {
        foreach ($quests as $quest) {
            if (!$this->quests->contains($quest)) {
                $this->quests->add($quest);
                $quest->setTrader($this);
            }
        }

        return $this;
    }

    /**
     * @param QuestInterface $quest
     * @return TraderInterface
     */
    public function removeQuest(QuestInterface $quest): TraderInterface
    {
        if ($this->quests->contains($quest)) {
            $this->quests->removeElement($quest);
            $quest->setTrader(null);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->__get('characterType');
    }
}
