<?php

namespace App\Interfaces;

interface TagRepositoryInterface
{
    /**
     * Finds the tag with the given ID.
     *
     * @param int $id
     *
     * @return TagInterface|null
     */
    public function findTagById(int $id): ?TagInterface;

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