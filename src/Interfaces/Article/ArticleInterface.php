<?php

namespace App\Interfaces\Article;

use DateTimeInterface;
use Symfony\Component\HttpFoundation\File\File;

interface ArticleInterface
{
    /**
     * @return int
     */
    public function getStatus(): int;

    /**
     * @param int|null $status
     * @return ArticleInterface
     */
    public function setStatus(?int $status): ArticleInterface;

    /**
     * @return string|null
     */
    public function getImagePoster(): ?string;

    /**
     * @param string|null $imagePoster
     * @return ArticleInterface
     */
    public function setImagePoster(?string $imagePoster): ArticleInterface;

    /**
     * @return File|null
     */
    public function getImageFile(): ?File;

    /**
     * @param File|null $imageFile
     * @return ArticleInterface
     */
    public function setImageFile(?File $imageFile): ArticleInterface;

    /**
     * @return int|null
     */
    public function getComplexity(): ?int;

    /**
     * @param int|null $complexity
     * @return ArticleInterface
     */
    public function setComplexity(?int $complexity): ArticleInterface;

    /**
     * @return DateTimeInterface|null
     */
    public function getReadingDuration(): ?DateTimeInterface;

    /**
     * @param DateTimeInterface|null $readingDuration
     * @return ArticleInterface
     */
    public function setReadingDuration(?DateTimeInterface $readingDuration): ArticleInterface;

    /**
     * @return ArticleCategoryInterface|null
     */
    public function getCategory(): ?ArticleCategoryInterface;

    /**
     * @param ArticleCategoryInterface|null $category
     * @return ArticleInterface
     */
    public function setCategory(?ArticleCategoryInterface $category): ArticleInterface;
}