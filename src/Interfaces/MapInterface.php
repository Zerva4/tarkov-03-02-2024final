<?php

declare(strict_types=1);

namespace App\Interfaces;

use Ramsey\Uuid\UuidInterface;

interface MapInterface
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
}