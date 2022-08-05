<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ArticleRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Symfony\Component\PropertyAccess\PropertyAccess;

#[ORM\Table(name: 'articles')]
#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article implements TranslatableInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;
    use TranslatableTrait;

    #[ORM\Column(type: 'boolean')]
    private bool $published;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $imagePoster;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        $this->defaultLocale = $defaultLocation;
    }

    public function __call($method, $arguments)
    {
        return PropertyAccess::createPropertyAccessor()->getValue($this->translate(), $method);
    }

    public function __get($name)
    {
        $method = 'get'. ucfirst($name);
        $arguments=[];
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
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

    public function getImagePoster(): ?string
    {
        return $this->imagePoster;
    }

    public function setImagePoster(?string $imagePoster): self
    {
        $this->imagePoster = $imagePoster;

        return $this;
    }
}
