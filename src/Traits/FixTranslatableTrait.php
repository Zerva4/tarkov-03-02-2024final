<?php

declare(strict_types=1);

namespace App\Traits;

trait FixTranslatableTrait
{
    public static function getTranslationEntityClass(): string
    {
        return self::class . 'Translation';
    }
}