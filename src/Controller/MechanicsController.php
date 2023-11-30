<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MechanicsController extends AbstractController
{
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
            'pagination' => $pagination,
        ]);
    }
}
