<?php

namespace App\Controller;

use App\Entity\Article\Article;
use App\Entity\Article\ArticleCategory;
use App\Repository\Article\ArticleCategoryRepository;
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

    #[Route('/news/{page<\d+>?1}', name: 'app_news', requirements: ['page' => '\d+'])]
    public function index(int $page, EntityManagerInterface $em, PaginatorInterface $paginator, Request $request): Response
    {
        $articleCategory = $em->getRepository(Article::class);

        $pagination = $paginator->paginate(
            $articleCategory->getQueryArticlesByCategory('ru', null, ArticleCategory::TYPE_UPDATE), /* query NOT result */
            $page, /*page number*/
            10 /*limit per page*/
        );

        return $this->render('mechanics/index.html.twig', [
            'currentCategory' => null,
            'categories' => $this->categories,
            'pagination' => $pagination,
        ]);
    }

    #[Route('/news/{slugCategory}/{page<\d+>?1}', name: 'app_news_category', requirements: ['page' => '\d+'])]
    public function indexByCategory(string $slugCategory, int $page, EntityManagerInterface $em, PaginatorInterface $paginator, Request $request): Response
    {
        $articleCategory = $em->getRepository(Article::class);
        $currentCategory = $this->findCurrentCategory($slugCategory);
        $pagination = $paginator->paginate(
            $articleCategory->getQueryArticlesByCategory('ru', $slugCategory), /* query NOT result */
            $page, /*page number*/
            10 /*limit per page*/
        );

        return $this->render('news/index.html.twig', [
            'currentCategory' => $currentCategory,
            'categories' => $this->categories,
            'pagination' => $pagination,
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
