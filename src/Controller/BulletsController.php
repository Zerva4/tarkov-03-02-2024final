<?php

declare(strict_types=1);

namespace App\Controller;

use App\Interfaces\Services\ItemServiceInterface;
use App\Repository\Item\ItemCaliberRepository;
use App\Repository\Item\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BulletsController extends AbstractController
{
    private ItemCaliberRepository $caliberRepository;
    private ItemRepository $itemRepository;

    public function __construct(ItemCaliberRepository $caliberRepository, ItemRepository $itemRepository)
    {
        $this->caliberRepository = $caliberRepository;
        $this->itemRepository = $itemRepository;
    }
    #[Route('/bullets', name: 'app_bullets')]
    public function index(): Response
    {
        $slug = $this->caliberRepository->findByType()[0]['slug'];

        return $this->redirectToRoute('app_view_bullet', ['slug' => $slug]);
    }

    #[Route('/bullets/{slug}/', name: 'app_view_bullet')]
    public function view(string $slug, ItemServiceInterface $itemService): Response
    {
        return $this->render('bullets/view.html.twig', [
            'slug' => $slug,
            'calibers' => $this->caliberRepository->findByType(),
            'items' => $itemService->getBySlug($slug)
        ]);
    }
}
