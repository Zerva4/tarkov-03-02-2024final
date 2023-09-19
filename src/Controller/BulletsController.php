<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\Item\ItemCaliberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BulletsController extends AbstractController
{
    #[Route('/bullets', name: 'app_bullets')]
    public function index(ItemCaliberRepository $caliberRepository): Response
    {
        return $this->render('bullets/index.html.twig', [
            'calibers' => $caliberRepository->findAll()
        ]);
    }
}
