<?php

declare(strict_types=1);

namespace App\Interfaces;

interface GraphQLClientInterface
{
    public function query(string $query, array $variables = [], ?string $token = null, string $endpoint = null ): string|array;
}