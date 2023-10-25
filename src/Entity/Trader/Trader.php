<?php

declare(strict_types=1);

namespace App\Entity\Trader;

use App\Entity\Barter;
use App\Entity\Quest\Quest;
use App\Entity\TranslatableEntity;
use App\Interfaces\BarterInterface;
use App\Interfaces\Quest\QuestInterface;
use App\Interfaces\Trader\TraderCashOfferInterface;
use App\Interfaces\Trader\TraderInterface;
use App\Interfaces\Trader\TraderLevelInterface;
use App\Interfaces\Trader\TraderRequiredInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Trader\TraderRepository;
use App\Traits\SlugTrait;
use App\Traits\UuidPrimaryKeyTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
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
class Trader extends TranslatableEntity implements UuidPrimaryKeyInterface, TraderInterface, TranslatableInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;
    use SlugTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $apiId;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0])]
    private int $position;

    #[ORM\Column(type: 'boolean')]
    private bool $published;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $imageName;

    #[Vich\UploadableField(mapping: 'traders', fileNameProperty: 'imageName')]
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

    #[ORM\Column(type: 'datetimetz', length: 255, nullable: true)]
    private ?DateTime $resetTime = null;

    #[ORM\OneToMany(mappedBy: 'trader', targetEntity: TraderLevel::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    #[ORM\OrderBy(['level' => 'ASC'])]
    private Collection $levels;

    #[ORM\OneToMany(mappedBy: 'trader', targetEntity: Barter::class, cascade: ['persist'], fetch: 'EXTRA_LAZY')]
    private Collection $barters;

    #[ORM\OneToMany(mappedBy: 'trader', targetEntity: Quest::class, cascade: ['persist'], fetch: 'EXTRA_LAZY')]
    private Collection $quests;

    #[ORM\OneToMany(mappedBy: 'trader', targetEntity: TraderRequired::class, cascade: ['persist'], fetch: 'EXTRA_LAZY')]
    private Collection $requiredTraders;

    #[ORM\OneToMany(mappedBy: 'trader', targetEntity: TraderCashOffer::class, cascade: ['persist'], fetch: 'EXTRA_LAZY')]
    private Collection $cashOffers;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        parent::__construct($defaultLocation);

        $this->levels = new ArrayCollection();
        $this->barters = new ArrayCollection();
        $this->requiredTraders = new ArrayCollection();
        $this->cashOffers = new ArrayCollection();
    }

    public function getApiId(): string
    {
        return $this->apiId;
    }

    public function setApiId(string $apiId): TraderInterface
    {
        $this->apiId = $apiId;

        return $this;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): TraderInterface
    {
        $this->position = $position;

        return $this;
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

    public function getFullName(): ?string
    {
        return $this->translate()->getFullName();
    }

    public function setFullName(?string $fullName): TraderInterface
    {
        $this->translate()->setFullName($fullName);

        return $this;
    }

    public function getShortName(): ?string
    {
        return $this->translate()->getShortName();
    }

    public function setShortName(string $shortName): TraderInterface
    {
        $this->translate()->setShortName($shortName);

        return $this;
    }

    public function getDescription(): string
    {
        return $this->translate()->getDescription();
    }

    public function setDescription(?string $description): TraderInterface
    {
        $this->translate()->setDescription($description);

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): TraderInterface
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile): TraderInterface
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->updatedAt = new DateTime('NOW');
        }

        return $this;
    }

    public function getResetTime(): ?DateTime
    {
        return $this->resetTime;
    }

    public function setResetTime(?DateTime $resetTime): TraderInterface
    {
        $this->resetTime = $resetTime;

        return $this;
    }

    public function getLevels(): Collection
    {
        return $this->levels;
    }

    public function setLevels(Collection $level): TraderInterface
    {
        $this->levels = $level;

        return $this;
    }

    public function addLevel(TraderLevelInterface $level): TraderInterface
    {
        if (!$this->levels->contains($level)) {
            $this->levels->add($level);
            $level->setTrader($this);
        }

        return $this;
    }

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
    public function getBarters(): Collection
    {
        return $this->barters;
    }

    /**
     * @param Collection $barters
     * @return TraderInterface
     */
    public function setBarters(Collection $barters): TraderInterface
    {
        $this->barters = $barters;

        return $this;
    }

    /**
     * @param BarterInterface $barter
     * @return TraderInterface
     */
    public function addBarter(BarterInterface $barter): TraderInterface
    {
        if (!$this->barters->contains($barter)) {
            $this->barters->add($barter);
            $barter->setTrader($this);
        }

        return $this;
    }

    /**
     * @param BarterInterface $barter
     * @return TraderInterface
     */
    public function removeBarter(BarterInterface $barter): TraderInterface
    {
        if ($this->barters->contains($barter)) {
            $this->barters->removeElement($barter);
        }

        return $this;
    }

    public function getQuests(): Collection
    {
        return $this->quests;
    }

    public function setQuests(Collection $quests): TraderInterface
    {
        $this->quests = $quests;

        return $this;
    }

    public function addQuest(QuestInterface $quest): TraderInterface
    {
        if (!$this->quests->contains($quest)) {
            $this->quests->add($quest);
            $quest->setTrader($this);
        }

        return $this;
    }

    public function removeQuest(QuestInterface $quest): TraderInterface
    {
        if ($this->quests->contains($quest)) {
            $this->quests->removeElement($quest);
            $quest->setTrader(null);
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getRequiredTraders(): Collection
    {
        return $this->requiredTraders;
    }

    /**
     * @param Collection $requiredTraders
     * @return TraderInterface
     */
    public function setRequiredTraders(Collection $requiredTraders): TraderInterface
    {
        $this->requiredTraders = $requiredTraders;

        return $this;
    }

    public function addRequiredTrader(TraderRequiredInterface $requiredTrader): TraderInterface
    {
        if (!$this->requiredTraders->contains($requiredTrader)) {
            $this->requiredTraders->add($requiredTrader);
            $requiredTrader->setTrader($this);
        }

        return $this;
    }

    public function removeRequiredTrader(TraderRequiredInterface $requiredTrader): TraderInterface
    {
        if (!$this->requiredTraders->contains($requiredTrader)) {
            $this->requiredTraders->add($requiredTrader);
            $requiredTrader->setTrader(null);
        }

        return $this;
    }

    public function getCashOffers(): Collection
    {
        return $this->cashOffers;
    }

    public function setCashOffers(Collection $cashOffers): TraderInterface
    {
        $this->cashOffers = $cashOffers;

        return $this;
    }

    public function addCashOffer(TraderCashOfferInterface $cashOffer): TraderInterface
    {
        if (!$this->cashOffers->contains($cashOffer)) {
            $this->cashOffers->add($cashOffer);
            $cashOffer->setTrader($this);
        }

        return $this;
    }

    public function removeCashOffer(TraderCashOfferInterface $cashOffer): TraderInterface
    {
        if (!$this->cashOffers->contains($cashOffer)) {
            $this->cashOffers->add($cashOffer);
            $cashOffer->setTrader(null);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getShortName();
    }
}
