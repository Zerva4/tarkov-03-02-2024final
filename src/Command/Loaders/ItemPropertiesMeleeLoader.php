<?php

declare(strict_types=1);

namespace App\Command\Loaders;

use App\Interfaces\Item\ItemPropertiesMeleeInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesMeleeLoader
{
    public function load(
        EntityManagerInterface $em,
        ItemPropertiesMeleeInterface $entityProperties,
        array $arrayProperties,
        string $locale = '%app.default_locale%'
    ): ItemPropertiesMeleeInterface
    {
        $entityProperties
            ->setSlashDamage($arrayProperties['slashDamage'] ?? 0)
            ->setStabDamage($arrayProperties['stabDamage'] ?? 0)
            ->setHitRadius($arrayProperties['hitRadius'] ?? 0)
        ;

        return $entityProperties;
    }
}