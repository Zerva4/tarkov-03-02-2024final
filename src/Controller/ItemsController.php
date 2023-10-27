<?php

declare(strict_types=1);

namespace App\Controller;

use App\Interfaces\Item\ItemInterface;
use App\Repository\Item\ContainedItemRepository;
use App\Repository\Item\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\Translation\t;

class ItemsController extends AbstractController
{
    #[Route('/item/{slug}', name: 'app_view_item')]
    public function getBySlug(string $slug, ItemRepository $itemRepository, ContainedItemRepository $containedItemRepository): Response
    {
        $item = $itemRepository->getItemBySlug($slug);

        if (!$item instanceof ItemInterface ) {
            throw $this->createNotFoundException(
                (string)t('Запрашиваемый ресурс не найден.', [], 'front.items')
            );
        }

        // Используется в квесте
        $usedInQuests = $containedItemRepository->findUsedInQuest($item);

        // Полученно из квеста
        $receivedFromQuests = $containedItemRepository->findReceivedFromQuest($item);

        return $this->render('items/view.html.twig', [
            'item' => $item,
            'usedInQuests' => $usedInQuests,
            'receivedFromQuests' => $receivedFromQuests,
        ]);
    }
}
