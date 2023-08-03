<?php

namespace App\Interfaces\Update;

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
}