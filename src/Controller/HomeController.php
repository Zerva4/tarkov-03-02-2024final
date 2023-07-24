<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\Trader\TraderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
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
