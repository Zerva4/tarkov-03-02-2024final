<?php

namespace App\Command\Loaders;

use App\Interfaces\Item\ItemPropertiesKeyInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesKeyLoader
{
    public function load(
        EntityManagerInterface $em,
        ItemPropertiesKeyInterface $entityProperties,
        array $arrayProperties,
        string $locale = '%app.default_locale%'
    ): ItemPropertiesKeyInterface
    {
        $entityProperties->setUses($arrayProperties['uses'] ?? 0);

        return $entityProperties;
    }
}