<?php

namespace App\Interfaces;

use Ramsey\Uuid\UuidInterface;

interface EnemieInterface
{
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
     * @return bool
     */
    public function isPublished(): bool;

    /**
     * @return bool
     */
    public function getPublished(): bool;

    /**
     * @param bool $published
     * @return EnemieInterface
     */
    public function setPublished(bool $published): EnemieInterface;
}