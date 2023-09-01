<?php

namespace App\Command\Loaders;

use App\Interfaces\Item\ItemPropertiesMedicalItemInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesMedicalItemLoader
{
    public function load(
        EntityManagerInterface $em,
        ItemPropertiesMedicalItemInterface $entityProperties,
        array $arrayProperties,
        string $locale = '%app.default_locale%'
    ): ItemPropertiesMedicalItemInterface
    {
        $entityProperties
            ->setUses($arrayProperties['uses'] ?? 0)
            ->setUseTime($arrayProperties['useTime'] ?? 0)
            ->setCures($arrayProperties['cures'] ?? [])
        ;

        return $entityProperties;
    }
}