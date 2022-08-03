<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TradersController extends AbstractController
{
    #[Route('/traders', name: 'app_traders')]
    public function index(): Response
    {
        return $this->render('traders/index.html.twig', [
            'controller_name' => 'TradersController',
        ]);
    }
}
