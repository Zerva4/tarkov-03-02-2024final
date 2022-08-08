<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\LocationInterface;
use App\Interfaces\QuestInterface;
use App\Interfaces\TraderInterface;
use App\Repository\QuestRepository;
use App\Traits\TranslatableMagicMethodsTrait;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'Quests')]
#[ORM\Index(columns: ['slug'], name: 'quests_slug_idx')]
#[ORM\Entity(repositoryClass: QuestRepository::class)]
class Quest implements QuestInterface, TranslatableInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;
    use TranslatableTrait;
    use TranslatableMagicMethodsTrait;

    #[ORM\Column(type: 'boolean')]
    private bool $published;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $imageName;

    #[ORM\ManyToOne(targetEntity: Trader::class, inversedBy: 'quests')]
    private ?TraderInterface $trader = null;

    #[ORM\ManyToOne(targetEntity: Location::class, inversedBy: 'quests')]
    private ?LocationInterface $location = null;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    #[Assert\NotBlank]
    #[Assert\Regex(pattern: '/^[a-z0-9]+(?:-[a-z0-9]+)*$/', message: 'Invalid format', match: true)]
    private string $slug;

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
     * @return LocationInterface|null
     */
    public function getLocation(): ?LocationInterface
    {
        return $this->location;
    }

    /**
     * @param LocationInterface|null $location
     * @return QuestInterface
     */
    public function setLocation(?LocationInterface $location): QuestInterface
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Quest
     */
    public function setSlug(string $slug): QuestInterface
    {
        $this->slug = $slug;

        return $this;
    }
}
