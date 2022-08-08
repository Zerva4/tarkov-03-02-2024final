<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\QuestInterface;
use App\Interfaces\TraderInterface;
use App\Interfaces\TraderLoyaltyInterface;
use App\Repository\TraderRepository;
use App\Traits\SlugTrait;
use App\Traits\TranslatableMagicMethodsTrait;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

#[ORM\Table(name: 'traders')]
#[ORM\Entity(repositoryClass: TraderRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Trader implements TraderInterface, TranslatableInterface, TimestampableInterface
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

    #[ORM\OneToMany(mappedBy: 'trader', targetEntity: TraderLoyalty::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    #[ORM\OrderBy(['level' => 'ASC'])]
    private Collection $loyalty;

    #[ORM\OneToMany(mappedBy: 'trader', targetEntity: Quest::class, cascade: ['persist'], fetch: 'EXTRA_LAZY')]
    private Collection $quests;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        $this->defaultLocale = $defaultLocation;
        $this->loyalty = new ArrayCollection();
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
    public function getLoyalty(): Collection
    {
        return $this->loyalty;
    }

    /**
     * @param Collection $loyalty
     * @return TraderInterface
     */
    public function setLoyalty(Collection $loyalty): TraderInterface
    {
        $this->loyalty = $loyalty;

        return $this;
    }

    /**
     * @param TraderLoyaltyInterface ...$loyalty
     * @return Trader
     */
    public function addLoyalty(TraderLoyaltyInterface ...$loyalty): TraderInterface
    {
        foreach ($loyalty as $loyaltyItem) {
            if (!$this->loyalty->contains($loyaltyItem)) {
                $this->loyalty->add($loyaltyItem);
                $loyaltyItem->setTrader($this);
            }
        }

        return $this;
    }

    /**
     * @param TraderLoyaltyInterface $loyalty
     * @return TraderInterface
     */
    public function removeLoyalty(TraderLoyaltyInterface $loyalty): TraderInterface
    {
        if ($this->loyalty->contains($loyalty)) {
            $this->loyalty->removeElement($loyalty);
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
