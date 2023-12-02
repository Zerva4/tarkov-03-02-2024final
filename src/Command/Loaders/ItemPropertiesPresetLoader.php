<?php

namespace App\Command\Loaders;

use App\Entity\Item\Item;
use App\Interfaces\Item\Properties\ItemPropertiesPresetInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesPresetLoader
{
    public function load(
        EntityManagerInterface $em,
        ItemPropertiesPresetInterface $entityProperties,
        array $arrayProperties,
        string $locale = '%app.default_locale%'
    ): ItemPropertiesPresetInterface
    {
        $entityBaseItem = null;
        $itemRepository = $em->getRepository(Item::class);

        if (isset($arrayProperties['defaultAmmo']))
            $entityBaseItem = $itemRepository->findOneBy(['apiId' => $arrayProperties['defaultAmmo']['id']]);

        $entityProperties
            ->setBaseItem($entityBaseItem)
            ->setErgonomics($arrayProperties['ergonomics'] ?? 0)
            ->setRecoilVertical($arrayProperties['recoilVertical'] ?? 0)
            ->setRecoilHorizontal($arrayProperties['recoilHorizontal'] ?? 0)
            ->setMoa($arrayProperties['moa'] ?? 0)
            ->setDefault($arrayProperties['default'] ?? false)
        ;

        unset($entityBaseItem, $itemRepository);

        return $entityProperties;
    }
}