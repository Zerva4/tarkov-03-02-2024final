<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MechanicsController extends AbstractController
{
    #[Route('/mechanics', name: 'app_mechanics')]
    public function index(): Response
    {
        return $this->render('mechanics/index.html.twig', [
            'controller_name' => 'MechanicsController',
        ]);
    }
}
