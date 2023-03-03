<?php

namespace App\Entity;

use App\Entity\Workshop\PlaceLevel;
use App\Interfaces\SkillInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Interfaces\Workshop\PlaceLevelInterface;
use App\Repository\SkillRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Table(name: 'skills')]
#[ORM\Index(columns: ['api_id'], name: 'skill_api_id_idx')]
#[ORM\Entity(repositoryClass: SkillRepository::class)]
class Skill extends TranslatableEntity implements UuidPrimaryKeyInterface, TranslatableInterface, TimestampableInterface, SkillInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $apiId = null;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0])]
    private int $level = 0;

    #[ORM\ManyToMany(targetEntity: PlaceLevel::class, mappedBy: 'requiredPlacesLevels', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    #[ORM\JoinTable(name: 'places_levels_required_skills')]
    private Collection $requiredForPlacesLevels;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        parent::__construct($defaultLocation);

        $this->requiredForPlacesLevels = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function getApiId(): ?string
    {
        return $this->apiId;
    }

    /**
     * @param string|null $apiId
     * @return SkillInterface
     */
    public function setApiId(?string $apiId): SkillInterface
    {
        $this->apiId = $apiId;

        return $this;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     * @return SkillInterface
     */
    public function setLevel(int $level): SkillInterface
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getRequiredForPlacesLevels(): Collection
    {
        return $this->requiredForPlacesLevels;
    }

    /**
     * @param Collection $requiredForPlacesLevels
     * @return SkillInterface
     */
    public function setRequiredForPlacesLevels(Collection $requiredForPlacesLevels): SkillInterface
    {
        $this->requiredForPlacesLevels = $requiredForPlacesLevels;

        return $this;
    }

    public function addRequiredForPlacesLevel(PlaceLevelInterface $placeLevel): SkillInterface
    {
        if (!$this->requiredForPlacesLevels->contains($placeLevel)) {
            $this->requiredForPlacesLevels->add($placeLevel);
            $placeLevel->addRequiredSkill($this);
        }

        return $this;
    }

    public function removeRequiredForPlacesLevel(PlaceLevelInterface $placeLevel): SkillInterface
    {
        if ($this->requiredForPlacesLevels->contains($placeLevel)) {
            $this->requiredForPlacesLevels->removeElement($placeLevel);
            $placeLevel->removeRequiredSkill($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->__get('title') . $this->getLevel();
    }
}
