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

    public function dataChange(): Response {
        $tmp = [
            '-14' => '1.0%',
            '-13' => '2.2%',
            '-12' => '3.6%',
            '-11' => '5.8%',
            '-10' => '7.8%',
            '-9' => '10.5%',
            '-8' => '13.6%',
            '-7' => '17.5%',
            '-6' => '23.1%',
            '-5' => '30.5%',
            '-4' => '40.0%',
            '-3' => '50.0%',
            '-2' => '61.5%',
            '-1' => '73.0%',
            '-0' => '85.0%',
            '1' => '97.2%',
            '2' => '89.0%',
            '3' => '90.8%',
            '4' => '93.0%',
            '5' => '94.7%',
            '6' => '96.4%',
            '7' => '97.5%',
            '8' => '98.5%',
            '9' => '99.0%',
            '10' => '99.8%',
        ];
        return $this->render('bullets/view.html.twig', [
            'tmp'=> $tmp
        ]);
    }
}
