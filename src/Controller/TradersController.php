<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\Trader\TraderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TradersController extends AbstractController
{
    #[Route('/traders', name: 'app_traders')]
    public function index(TraderRepository $traderRepository, ArticleRepository $articleRepository): Response
    {
        $tradersList = $traderRepository->findAllTraders();
        $articlesList = $articleRepository->findLastHomeArticles(3);

        return $this->render('home/index.html.twig', [
            'traders' => $tradersList,
            'articles' => $articlesList,
        ]);
    }
}
