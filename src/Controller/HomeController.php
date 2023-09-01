<?php

declare(strict_types=1);

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
        $tradersList = $traderRepository->findAll();
        $articlesList = $articleRepository->findLastHomeArticles(3);

        return $this->render('home/index.html.twig', [
            'traders' => $tradersList,
            'articles' => $articlesList,
        ]);
    }

//    #[Route('/delete', name: 'app_delete')]
//    public function delete(EntityManagerInterface $em): Response
//    {
//        $query = $em->createQuery(
//            'DELETE FROM App\Entity\Item\ItemPropertiesFoodDrink e WHERE e.energy >= :ageparameter'
//        )->setParameter('ageparameter', 0)->execute();
//        $em->flush();
//
//        return $this->render('home/index.html.twig', [
//            'traders' => $tradersList,
//            'articles' => $articlesList,
//        ]);
//    }
}
