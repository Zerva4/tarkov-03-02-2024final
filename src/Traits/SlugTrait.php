<?php

declare(strict_types=1);

namespace App\Traits;

use App\Entity\Article\Article;
use App\Entity\Article\ArticleCategoryTranslation;
use App\Entity\Boss;
use App\Entity\Item\Item;
use App\Entity\Map;
use App\Entity\Quest\Quest;
use App\Entity\Trader\Trader;
use App\Entity\Update\Update;
use App\Entity\Update\UpdateCategory;
use App\Entity\Workshop\Place;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait SlugTrait
{
    #[ORM\Column(type: 'string', length: 255, unique: true, nullable: false)]
    #[Assert\NotBlank]
    #[Assert\Regex(pattern: '/^[a-z0-9]+(?:-[a-z0-9]+)*$/', message: 'Invalid format', match: true)]
    private string $slug;

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Trader|Article|ArticleCategoryTranslation|Boss|Item|Map|Quest|Update|UpdateCategory|Place|SlugTrait
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}