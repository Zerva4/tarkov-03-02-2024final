<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BulletsController extends AbstractController
{
    #[Route('/bullets', name: 'app_bullets')]
    public function index(): Response
    {
        return $this->render('bullets/index.html.twig', [
        ]);
    }
}
