<?php

declare(strict_types=1);

namespace App\Command\Loaders;

use App\Interfaces\Item\ItemPropertiesBackpackInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesBackpackLoader
{
    public function load(
        EntityManagerInterface $em,
        ItemPropertiesBackpackInterface $entityProperties,
        array $arrayProperties,
        string $locale = '%app.default_locale%'
    ): ItemPropertiesBackpackInterface
    {
        $entityProperties
            ->setCapacity($arrayProperties['capacity'])
            ->setSpeedPenalty($arrayProperties['speedPenalty'])
            ->setTurnPenalty($arrayProperties['turnPenalty'])
            ->setErgoPenalty($arrayProperties['ergoPenalty'])
            // todo: ItemStorageGrid[]
        ;

        return $entityProperties;
    }
}