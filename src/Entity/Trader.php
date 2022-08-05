<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\TraderInterface;
use App\Interfaces\TraderLoyaltyInterface;
use App\Repository\TraderRepository;
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
    use TranslatableTrait;
    use TranslatableMagicMethodsTrait;

    #[ORM\Column(type: 'boolean')]
    private bool $published;

    #[ORM\Column(type: 'string', length: 255, unique: true, nullable: false)]
    private string $slug;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $imageName;

    #[ORM\OneToMany(mappedBy: 'trader', targetEntity: TraderLoyalty::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    #[ORM\OrderBy(['level' => 'ASC'])]
    private Collection $loyalty;

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
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
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
     */
    public function setLoyalty(Collection $loyalty): void
    {
        $this->loyalty = $loyalty;
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
}
