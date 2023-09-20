<?php

namespace App\Interfaces\Services;

interface ItemServiceInterface
{
    public function getByCaliber(string $caliber, bool $isAmmo = true): ?array;
    public function getBySlug(string $slug, bool $isAmmo = true): ?array;
}