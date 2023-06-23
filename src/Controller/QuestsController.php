<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestsController extends AbstractController
{
    #[Route('/quests', name: 'app_quests')]
    public function index(): Response
    {
        return $this->render('quests/index.html.twig', [
            'controller_name' => 'QuestsController',
        ]);
    }

    #[Route('/quests/{questName}', name: 'app_view_quest', requirements: ['traderName' => '^[A-Za-z0-9-]*$'])]
    public function viewQuest(string $questName): Response
    {
        return $this->render('quests/index.html.twig', [
            'controller_name' => 'QuestsController',
        ]);
    }
}
