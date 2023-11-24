<?php

namespace App\Service;

use App\Entity\Item\Item;
use App\Entity\Item\ItemCaliber;
use App\Interfaces\Services\ItemServiceInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemService implements ItemServiceInterface
{
    private EntityManagerInterface $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getByCaliber(string $caliber = 'Caliber556x45NATO', bool $isAmmo = true): array
    {
        $itemsIds = [];

        $caliberRepository = $this->em->getRepository(ItemCaliber::class);
        $caliberEntity = $caliberRepository->findByCaliber($caliber, $isAmmo);

        foreach ($caliberEntity->getProperties() as $properties) {
            $itemsIds[] = $properties->getItem()->getId();
        }

        $itemRepository = $this->em->getRepository(Item::class);

        return $itemRepository->findBy([
            'id' => $itemsIds
        ]);
    }

    public function getBySlug(string $slug, bool $isAmmo = true): array
    {
        $itemsIds = [];

        $caliberRepository = $this->em->getRepository(ItemCaliber::class);
        $caliberEntity = $caliberRepository->findBySlug($slug, $isAmmo);

        foreach ($caliberEntity->getProperties() as $properties) {
            $itemsIds[] = $properties->getItem()->getId();
        }

        $itemRepository = $this->em->getRepository(Item::class);

        return $itemRepository->findBy([
            'id' => $itemsIds
        ]);
    }
}