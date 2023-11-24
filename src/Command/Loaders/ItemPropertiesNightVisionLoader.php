<?php

declare(strict_types=1);

namespace App\Command\Loaders;

use App\Interfaces\Item\Properties\ItemPropertiesNightVisionInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesNightVisionLoader
{
    public function load(
        EntityManagerInterface $em,
        ItemPropertiesNightVisionInterface $entityProperties,
        array $arrayProperties,
        string $locale = '%app.default_locale%'
    ): ItemPropertiesNightVisionInterface
    {
        $entityProperties
            ->setIntensity($arrayProperties['intensity'] ?? 0)
            ->setNoiseIntensity($arrayProperties['noiseIntensity'] ?? 0)
            ->setNoiseScale($arrayProperties['noiseScale'] ?? 0)
            ->setDiffuseIntensity($arrayProperties['diffuseIntensity'] ?? 0)
        ;

        return $entityProperties;
    }
}