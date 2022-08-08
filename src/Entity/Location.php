<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\LocationInterface;
use App\Interfaces\QuestInterface;
use App\Repository\LocationRepository;
use App\Traits\TranslatableMagicMethodsTrait;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

#[ORM\Table(name: 'Locations')]
#[ORM\Index(columns: ['slug'], name: 'slug_idx')]
#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location implements LocationInterface, TranslatableInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TranslatableTrait;
    use TimestampableTrait;
    use TranslatableMagicMethodsTrait;

    #[ORM\Column(type: 'boolean')]
    private bool $published;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $imageName;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private ?string $numberOfPlayers;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $raidDuration;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $slug;

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

    public function getRaidDuration(): ?float
    {
        return $this->raidDuration;
    }

    public function setRaidDuration(?float $raidDuration): self
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
     * @return LocationInterface
     */
    public function setQuests(Collection $quests): LocationInterface
    {
        $this->quests = $quests;

        return $this;
    }

    /**
     * @param QuestInterface ...$quests
     * @return LocationInterface
     */
    public function addQuest(QuestInterface ...$quests): LocationInterface
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
     * @return LocationInterface
     */
    public function removeQuest(QuestInterface $quest): LocationInterface
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
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string|null $slug
     */
    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }
}
