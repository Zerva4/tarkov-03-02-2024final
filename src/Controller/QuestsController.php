<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Quest\QuestAdvice;
use App\Entity\Quest\QuestObjective;
use App\Interfaces\Quest\QuestAdviceInterface;
use App\Interfaces\Quest\QuestInterface;
use App\Repository\Quest\QuestObjectiveRepository;
use App\Repository\Quest\QuestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\Translation\t;

class QuestsController extends FrontController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/quests', name: 'app_quests')]
    public function index(): Response
    {
        return $this->render('quests/view.html.twig', [
            'controller_name' => 'QuestsController',
        ]);
    }

    #[Route('/quest/{slug}', name: 'app_view_quest', requirements: ['traderName' => '^[A-Za-z0-9-]*$'])]
    public function viewQuest(string $slug, QuestRepository $questRepository, QuestObjectiveRepository $questObjectiveRepository): Response
    {
        $adviceBody = null;
        $questAdviceRepository = $this->em->getRepository(QuestAdvice::class);
        $quest = $questRepository->findQuestBySlug($slug, $this->getLocale());
        $quest->getRandomAdvice();
        if (!$quest instanceof QuestInterface ) {
            throw $this->createNotFoundException(
                (string)t('Запрашиваемый ресурс не найден.', [], 'front.items')
            );
        }
        $advice = $questAdviceRepository->findRandomAdvice($quest);
        if ($advice instanceof QuestAdviceInterface)
            $adviceBody = $advice->getBody();

        return $advice->render('quests/view.html.twig', [
            'advice' => $adviceBody,
            'quest' => $quest,
        ]);
    }
}
