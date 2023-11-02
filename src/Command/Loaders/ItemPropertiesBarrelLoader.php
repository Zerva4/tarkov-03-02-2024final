<?php

declare(strict_types=1);

namespace App\Command\Loaders;

use App\Interfaces\Item\Properties\ItemPropertiesBarrelInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesBarrelLoader
{
    public function load(
        EntityManagerInterface $em,
        ItemPropertiesBarrelInterface $entityProperties,
        array $arrayProperties,
        string $locale = '%app.default_locale%'
    ): ItemPropertiesBarrelInterface
    {
        $entityProperties
            ->setErgonomics($arrayProperties['ergonomics'])
            ->setRecoilModifier($arrayProperties['recoilModifier'])
            ->setCenterOfImpact($arrayProperties['centerOfImpact'])
            ->setDeviationCurve($arrayProperties['deviationCurve'])
            ->setDeviationMax($arrayProperties['deviationMax'])
            // todo: Slots
        ;

        return $entityProperties;
    }
}