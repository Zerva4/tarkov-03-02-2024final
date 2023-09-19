<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\MapRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MapsController extends AbstractController
{
    #[Route('/maps', name: 'app_maps')]
    public function index(MapRepository $mapRepository): Response
    {
        return $this->render('maps/index.html.twig', [
            'maps' => $mapRepository->findAll(),
        ]);
    }
}
