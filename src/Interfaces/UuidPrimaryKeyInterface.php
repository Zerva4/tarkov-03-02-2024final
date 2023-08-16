<?php

namespace App\Interfaces;

use Ramsey\Uuid\UuidInterface;

interface UuidPrimaryKeyInterface
{
    /**
     * @return UuidInterface|null
     */
    public function getId(): ?UuidInterface;

    /**
     * @param UuidInterface $id
     * @return void
     */
    public function setId(UuidInterface $id): void;
}