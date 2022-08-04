<?php

declare(strict_types=1);

namespace App\Interfaces;

use Ramsey\Uuid\UuidInterface;

/**
 * Interface for tag entity.
 */
interface TagInterface
{
    public const ENTITY_ID = 'tags';

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface;

    /**
     * @param UuidInterface $id
     * @return void
     */
    public function setId(UuidInterface $id): void;

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