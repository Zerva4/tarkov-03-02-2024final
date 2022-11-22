<?php

namespace App\Interfaces;

use Ramsey\Uuid\UuidInterface;

interface MapLocationInterface
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