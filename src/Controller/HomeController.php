<?php

namespace App\Controller;

use App\Repository\Trader\TraderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(TraderRepository $traderRepository): Response
    {
        $tradersList = $traderRepository->findAllTraders();
        dump($tradersList);

        return $this->render('home/index.html.twig', [
            'traders' => $tradersList,
        ]);
    }
}
