<?php

namespace App\Controller;

use App\Repository\Quest\QuestObjectiveRepository;
use App\Repository\Quest\QuestRepository;
use Doctrine\ORM\AbstractQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestsController extends AbstractController
{
    #[Route('/quests', name: 'app_quests')]
    public function index(): Response
    {
        return $this->render('quests/view.html.twig', [
            'controller_name' => 'QuestsController',
        ]);
    }

    #[Route('/quests/{slug}', name: 'app_view_quest', requirements: ['traderName' => '^[A-Za-z0-9-]*$'])]
    public function viewQuest(string $slug, QuestRepository $questRepository, QuestObjectiveRepository $questObjectiveRepository): Response
    {
        $quest = $questRepository->findQuestBySlug($slug);
        $objectives = $questObjectiveRepository->findObjectivesByQuestId($quest['id'], AbstractQuery::HYDRATE_ARRAY);

        return $this->render('quests/view.html.twig', [
            'quest' => $quest,
            'objectives' => $objectives
        ]);
    }
}
