<?php

namespace App\Interfaces;

/**
 * Interface for tag entity.
 */
interface TagInterface
{
    public const ENTITY_ID = 'tags';

    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @param int $id
     * @return TagInterface
     */
    public function setId(int $id): TagInterface;

    /**
     * @return string|null
     */
    public function getName(): ?string;
    /**
     * @param string $name
     * @return TagInterface
     */
    public function setName(string $name): TagInterface;
}