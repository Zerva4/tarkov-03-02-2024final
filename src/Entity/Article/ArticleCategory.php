<?php

namespace App\Entity\Article;

use App\Entity\TranslatableEntity;
use App\Interfaces\Article\ArticleCategoryInterface;
use App\Interfaces\Article\ArticleInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Article\ArticleCategoryRepository;
use App\Traits\SlugTrait;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Table(name: 'articles_category')]
#[ORM\Index(columns: ['slug'], name: 'articles_category_slug_idx')]
#[ORM\Entity(repositoryClass: ArticleCategoryRepository::class)]
class ArticleCategory extends TranslatableEntity implements ArticleCategoryInterface, UuidPrimaryKeyInterface, TranslatableInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;
    use SlugTrait;

    public const TYPE_ARTICLE = 0;
    public const TYPE_UPDATE = 1;

    #[ORM\Column(type: 'boolean')]
    private bool $published;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Тип категории'])]
    private int $type;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Article::class, cascade: ['persist'], fetch: 'EXTRA_LAZY')]
    private Collection $articles;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        parent::__construct($defaultLocation);

        $this->articles  = new ArrayCollection();
    }

    public function isPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): ArticleCategoryInterface
    {
        $this->published = $published;

        return $this;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): ArticleCategoryInterface
    {
        $this->type = $type;

        return $this;
    }

    public function getName(): string
    {
        return $this->translate()->getName();
    }

    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function setArticles(Collection $articles): ArticleCategoryInterface
    {
        $this->articles = $articles;

        return $this;
    }

    public function addArticle(ArticleInterface $article): ArticleCategoryInterface
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setCategory($this);
        }

        return $this;
    }

    public function removeArticle(ArticleInterface $article): ArticleCategoryInterface
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            $article->setCategory(null);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
