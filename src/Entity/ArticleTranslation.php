<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\TagInterface;
use App\Repository\ArticleTranslationRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;

#[ORM\Table(name: 'articles_translation')]
#[ORM\Index(columns: ['locale'], name: 'articles_locale_idx')]
#[ORM\Entity(repositoryClass: ArticleTranslationRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ArticleTranslation implements TranslationInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TranslationTrait;
    use TimestampableTrait;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description;

    #[ORM\Column(type: 'text')]
    private string $body;

    #[ORM\JoinTable(name: 'articles_tags')]
    #[ORM\ManyToMany(targetEntity: Tag::class, cascade: ['persist'])]
    private ?Collection $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return TagInterface[]|null
     */
    public function getTags(): ?Collection
    {
        return $this->tags;
    }

    /**
     * @param ArrayCollection $tags
     * @return ArticleTranslation
     */
    public function setTags(ArrayCollection $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @param TagInterface ...$tags
     * @return ArticleTranslation
     */
    public function addTag(TagInterface ...$tags): self
    {
        foreach ($tags as $tag) {
            if (!$this->tags->contains($tag)) {
                $this->tags->add($tag);
            }
        }

        return $this;
    }

    /**
     * @param Tag $tag
     * @return void
     */
    public function removeTag(TagInterface $tag): void
    {
        $this->tags->removeElement($tag);
    }
}