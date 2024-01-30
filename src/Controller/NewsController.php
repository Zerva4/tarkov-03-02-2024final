<?php

namespace App\Controller;

use App\Entity\Article\Article;
use App\Entity\Article\ArticleCategory;
use App\Repository\Article\ArticleCategoryRepository;
use App\Repository\Article\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\Translation\t;

class NewsController extends FrontController
{
    private ?array $categories;
    private ContainerBagInterface $params;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __construct(ContainerBagInterface $params, ArticleCategoryRepository $categoryRepository)
    {
        $this->params = $params;
        $this->categories = $categoryRepository->findAllCategory(
            $this->params->get('app.default_locale'),
            ArticleCategory::TYPE_UPDATE
        );
    }

    public function findCurrentCategory(string $slug): ?array
    {
        foreach($this->categories as $category) {
            if ($category['slug'] === $slug) return $category;
        }

        return null;
    }

    #[Route('/news', name: 'app_news')]
    public function index(EntityManagerInterface $em, Request $request): Response
    {
        return $this->redirectToRoute('app_news_category', ['slugCategory' => $this->categories[0]['slug']]);
    }

    #[Route('/news/{slugCategory}', name: 'app_news_category')]
    public function indexByCategory(string $slugCategory, EntityManagerInterface $em, Request $request): Response
    {
        $currentCategory = $this->findCurrentCategory($slugCategory);
        $articlesRepository = $em->getRepository(Article::class);
        $articlesList = $articlesRepository->getQueryNewsByCategory(
            $this->params->get('app.default_locale'),
            10,
            $slugCategory,
            ArticleCategory::TYPE_UPDATE
        )->getResult();

        return $this->render('news/index.html.twig', [
            'currentCategory' => $currentCategory,
            'categories' => $this->categories,
            'articles' => $articlesList
        ]);
    }

    #[Route('/news/{slugCategory}/{slugArticle}', name: 'app_news_view')]
    public function view(string $slugCategory, string $slugArticle, EntityManagerInterface $em, Request $request): Response
    {
        $currentCategory = $this->findCurrentCategory($slugCategory);
        if (null === $currentCategory) {
            throw $this->createNotFoundException(
                (string)t('Запрашиваемый ресурс не найден.', [], 'front.items')
            );
        }

        $articleRepository = $em->getRepository(Article::class);
        $article = $articleRepository->findArticleBySlug($slugCategory, $slugArticle);
        if (null === $article) {
            throw $this->createNotFoundException(
                (string)t('Запрашиваемый ресурс не найден.', [], 'front.items')
            );
        }

        return $this->render('news/view.html.twig', [
            'article' => $article,
        ]);
    }
}
