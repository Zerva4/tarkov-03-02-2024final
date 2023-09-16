<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LocationsController extends AbstractController
{
    #[Route('/locations', name: 'app_locations')]
    public function index(): Response
    {
        return $this->render('locations/index.html.twig', [
            'controller_name' => 'LocationsController',
        ]);
    }
}
