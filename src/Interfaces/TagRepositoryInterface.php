<?php

declare(strict_types=1);

namespace App\Interfaces;

use Ramsey\Uuid\UuidInterface;

interface TagRepositoryInterface
{
    /**
     * Finds the tag with the given ID.
     *
     * @param UuidInterface $id
     *
     * @return TagInterface|null
     */
    public function findTagById(UuidInterface $id): ?TagInterface;

    /**
     * Finds the tag with the given name.
     *
     * @param string $name
     *
     * @return TagInterface|null
     */
    public function findTagByName(string $name): ?TagInterface;

    /**
     * Searches for all tags.
     *
     * @return array|null
     */
    public function findAllTags(): ?array;
}