<?php

declare(strict_types=1);

namespace App\Interfaces;

use Ramsey\Uuid\UuidInterface;

/**
 * Interface for Tag entity.
 */
interface TagInterface
{
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