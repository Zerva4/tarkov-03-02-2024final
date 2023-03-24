<?php

namespace App\Controller;

use App\Repository\Item\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemsController extends AbstractController
{
    #[Route('/items', name: 'app_items')]
    public function index(): Response
    {
        return $this->render('items/index.html.twig', [
            'controller_name' => 'ItemsController',
        ]);
    }

    #[Route('/items/{slug}', name: 'app_items_by_slug')]
    public function getBySlug(string $slug, ItemRepository $itemRepository): Response
    {
        $item = $itemRepository->getItemBySlug($slug);

        return $this->render('items/index.html.twig', [
            'item' => $item,
        ]);
    }
}
