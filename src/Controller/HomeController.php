<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Article\ArticleCategory;
use App\Repository\Article\ArticleCategoryRepository;
use App\Repository\Article\ArticleRepository;
use App\Repository\Trader\TraderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(TraderRepository $traderRepository, ArticleRepository $articleRepository, ArticleCategoryRepository $categoryRepository): Response
    {
        $tradersList = $traderRepository->findAll();
        $articlesList = $articleRepository->findLastArticles('ru', 3, ArticleCategory::TYPE_ARTICLE);
        $newsCategories = $categoryRepository->findAllCategory('ru', ArticleCategory::TYPE_UPDATE);

        return $this->render('home/index.html.twig', [
            'traders' => $tradersList,
            'lastArticles' => $articlesList,
            'newsCategories' => $newsCategories
        ]);
    }
}
