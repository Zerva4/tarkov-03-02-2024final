<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\Quest\QuestRepository;
use App\Repository\Trader\TraderLevelRepository;
use App\Repository\Trader\TraderRepository;
use Doctrine\ORM\AbstractQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TradersController extends FrontController
{
    private TraderRepository $traderRepository;
    private ?array $traders = null;

    public function __construct(Request $request, TraderRepository $traderRepository)
    {
        $this->traderRepository = $traderRepository;
    }

    #[Route('/traders', name: 'app_traders')]
    public function index(): Response
    {
        $this->traders = $this->traderRepository->findAllTraders(
            $this->getLocale()
        );
        return $this->redirectToRoute('app_view_trader', ['traderName' => $this->traders[0]['slug']]);
    }

    #[Route('/traders/{traderName}', name: 'app_view_trader', requirements: ['traderName' => '^[A-Za-z]*$'])]
    public function trader(string $traderName, TraderLevelRepository $levelRepository, QuestRepository $questRepository): Response
    {
        $this->traders = $this->traderRepository->findAllTraders(
            $this->getLocale()
        );
        $trader = $this->search_array($this->traders, 'slug', $traderName);
        $traderLevels = $levelRepository->findLevelsByTraderId($trader['id'], AbstractQuery::HYDRATE_ARRAY);
        $traderQuests = $questRepository->findQuestsByTraderId($trader['id'], $this->getLocale(), AbstractQuery::HYDRATE_ARRAY);

        if (empty($trader)) $this->createNotFoundException();

        return $this->render('traders/trader.html.twig', [
            'traders' => $this->traders,
            'trader' => $trader,
            'levels' => $traderLevels,
            'quests' => $traderQuests
        ]);
    }

    protected function search_array( $array, $key, $value )
    {
        $traderIndex = array_search($value,array_column($array,$key), true);

        return $this->traders[$traderIndex];
    }
}
