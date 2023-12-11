<?php

namespace App\Interfaces\Article;

use Doctrine\Common\Collections\Collection;

interface ArticleCategoryInterface
{
    /**
     * @return bool
     */
    public function isPublished(): bool;

    /**
     * @param bool $published
     * @return ArticleCategoryInterface
     */
    public function setPublished(bool $published): ArticleCategoryInterface;

    /**
     * @return Collection
     */
    public function getArticles(): Collection;

    /**
     * @param Collection $articles
     * @return ArticleCategoryInterface
     */
    public function setArticles(Collection $articles): ArticleCategoryInterface;

    /**
     * @param ArticleInterface $article
     * @return ArticleCategoryInterface
     */
    public function addArticle(ArticleInterface $article): ArticleCategoryInterface;

    /**
     * @param ArticleInterface $article
     * @return ArticleCategoryInterface
     */
    public function removeArticle(ArticleInterface $article): ArticleCategoryInterface;
}