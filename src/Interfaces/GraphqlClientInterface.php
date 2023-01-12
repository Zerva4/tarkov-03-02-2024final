<?php

namespace App\Interfaces;

interface GraphqlClientInterface
{
    public function query(string $query, array $variables = [], ?string $token = null, string $endpoint = null ): string|array;
}