<?php

declare(strict_types=1);

namespace App\Interfaces\Update;

use Doctrine\Common\Collections\Collection;

interface UpdateCategoryInterface
{
    /**
     * @return bool
     */
    public function isPublished(): bool;

    /**
     * @param bool $published
     * @return UpdateCategoryInterface
     */
    public function setPublished(bool $published): UpdateCategoryInterface;

    /**
     * @return Collection
     */
    public function getUpdates(): Collection;

    /**
     * @param Collection $updates
     * @return UpdateCategoryInterface
     */
    public function setUpdates(Collection $updates): UpdateCategoryInterface;

    /**
     * @param UpdateInterface $update
     * @return UpdateCategoryInterface
     */
    public function addUpdate(UpdateInterface $update): UpdateCategoryInterface;

    /**
     * @param UpdateInterface $update
     * @return UpdateCategoryInterface
     */
    public function removeUpdate(UpdateInterface $update): UpdateCategoryInterface;
}