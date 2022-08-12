<?php

namespace App\Entity;

use App\Repository\EnemyTranslationRepository;
use App\Traits\UuidPrimaryKeyTrait;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;

#[ORM\Table(name: 'enemies_translation')]
#[ORM\Entity(repositoryClass: EnemyTranslationRepository::class)]
class EnemyTranslation implements TranslationInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TranslationTrait;
    use TimestampableTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $behavior = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $followers = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $strategy = null;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return EnemyTranslation
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBehavior(): ?string
    {
        return $this->behavior;
    }

    /**
     * @param string|null $behavior
     */
    public function setBehavior(?string $behavior): void
    {
        $this->behavior = $behavior;
    }

    /**
     * @return string|null
     */
    public function getFollowers(): ?string
    {
        return $this->followers;
    }

    /**
     * @param string|null $followers
     */
    public function setFollowers(?string $followers): void
    {
        $this->followers = $followers;
    }

    /**
     * @return string|null
     */
    public function getStrategy(): ?string
    {
        return $this->strategy;
    }

    /**
     * @param string|null $strategy
     */
    public function setStrategy(?string $strategy): void
    {
        $this->strategy = $strategy;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName();
    }
}
