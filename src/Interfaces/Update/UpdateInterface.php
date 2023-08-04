<?php

namespace App\Interfaces\Update;

use DateTime;

interface UpdateInterface
{
    /**
     * @return UpdateCategoryInterface|null
     */
    public function getCategory(): ?UpdateCategoryInterface;

    /**
     * @param UpdateCategoryInterface|null $category
     * @return UpdateInterface
     */
    public function setCategory(?UpdateCategoryInterface $category): UpdateInterface;

    /**
     * @return bool
     */
    public function isPublished(): bool;

    /**
     * @param bool $published
     * @return UpdateInterface
     */
    public function setPublished(bool $published): UpdateInterface;

    /**
     * @return DateTime
     */
    public function getDateAdded(): DateTime;

    /**
     * @param DateTime $addedDate
     * @return UpdateInterface
     */
    public function setDateAdded(DateTime $addedDate): UpdateInterface;
}