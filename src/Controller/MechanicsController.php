<?php

namespace App\Controller;

use App\Entity\Article\Article;
use App\Repository\Article\ArticleCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MechanicsController extends FrontController
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
            $this->params->get('app.default_locale')
        );
    }

    #[Route('/mechanics', name: 'app_mechanics')]
    public function index(EntityManagerInterface $em, PaginatorInterface $paginator, Request $request): Response
    {
        $dql   = "SELECT a FROM App\Entity\Article\Article a";
        $query = $em->createQuery($dql);

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('mechanics/index.html.twig', [
            'categories' => $this->categories,
            'pagination' => $pagination,
        ]);
    }

    #[Route('/mechanics/{slugCategory}', name: 'app_mechanics_category')]
    public function viewByCategory(string $slugCategory, EntityManagerInterface $em, PaginatorInterface $paginator, Request $request): Response
    {
        dump($slugCategory);
        $articleCategory = $em->getRepository(Article::class);

        $pagination = $paginator->paginate(
            $articleCategory->findArticleByCategory($slugCategory), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        dump($pagination);

        return $this->render('mechanics/index.html.twig', [
            'categories' => $this->categories,
            'pagination' => $pagination,
        ]);
    }
}
