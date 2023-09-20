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
    private ?array $calibers;

    public function __construct(ItemCaliberRepository $caliberRepository)
    {
        $this->calibers = $caliberRepository->findByType();
    }
    #[Route('/bullets', name: 'app_bullets')]
    public function index(): Response
    {
        return $this->redirectToRoute('app_view_bullet', ['slug' => $this->calibers[0]['slug']]);
    }

    #[Route('/bullets/{slug}/', name: 'app_view_bullet')]
    public function view(string $slug, ItemServiceInterface $itemService): Response
    {
        return $this->render('bullets/view.html.twig', [
            'slug' => $slug,
            'calibers' => $this->calibers,
            'items' => $itemService->getBySlug($slug)
        ]);
    }
}
