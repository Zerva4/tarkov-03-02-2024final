<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Barter;
use App\Entity\Boss;
use App\Entity\Items\Item;
use App\Entity\Items\ItemMaterial;
use App\Entity\Map;
use App\Entity\Quests\Quest;
use App\Entity\Quests\QuestItem;
use App\Entity\Trader;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\Translation\t;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Eft Site')
            ->renderContentMaximized()
            ->generateRelativeUrls()
            ->setTranslationDomain('admin')
            ->disableDarkMode(true)
        ;
    }

    public function configureAssets(): Assets
    {
        return parent::configureAssets()
            ->addWebpackEncoreEntry('admin');
    }

    public function configureMenuItems(): iterable
    {
        $itemsMenu = [
            MenuItem::linkToCrud(t('Сommon', [], 'menu'), '', Item::class)->setController(ItemCrudController::class)->setLinkRel('noreferrer'),
            MenuItem::linkToCrud(t('Quest', [], 'menu'), '', QuestItem::class)->setController(QuestItemCrudController::class)->setLinkRel('noreferrer'),
            MenuItem::linkToCrud(t('Materials', [], 'menu'), '', ItemMaterial::class)->setController(ItemMaterialCrudController::class)->setLinkRel('noreferrer'),
            MenuItem::linkToCrud(t('Barters', [], 'menu'), '', Barter::class)->setController(BarterCrudController::class),
            MenuItem::linkToCrud(t('Crafts', [], 'menu'), '', Barter::class)->setController(BarterCrudController::class),
        ];
        yield MenuItem::section(t('Content', [], 'menu'), '');
        yield MenuItem::linkToCrud(t('Maps', [], 'menu'), 'fa fa-map', Map::class)->setController(MapCrudController::class);
        yield MenuItem::linkToCrud(t('Traders', [], 'menu'), 'fa fa-hand-holding-usd', Trader::class)->setController(TraderCrudController::class);
        yield MenuItem::subMenu(t('Items', [], 'menu'), 'fa fa-cubes')->setSubItems($itemsMenu);
        yield MenuItem::linkToCrud(t('Quests', [], 'menu'), 'fa fa-question-circle', Quest::class)->setController(QuestCrudController::class);
        yield MenuItem::linkToCrud(t('Enemies', [], 'menu'), 'fa fa-skull', Boss::class)->setController(BossCrudController::class);
        yield MenuItem::linkToDashboard(t('Updates', [], 'menu'), 'fa fa-sync');
        yield MenuItem::linkToCrud(t('Articles', [], 'menu'), 'fa fa-newspaper', Article::class)->setController(ArticleCrudController::class);
        yield MenuItem::section(t('Materials', [], 'menu'), '');
        yield MenuItem::linkToDashboard(t('Photos', [], 'menu'), 'fa fa-camera');
        yield MenuItem::linkToDashboard(t('Videos', [], 'menu'), 'fa fa-video-camera');
        yield MenuItem::section(t('Management', [], 'menu'), '');
        yield MenuItem::linkToCrud(t('Users', [], 'menu'), 'fa fa-user-gear', User::class)->setController(UserCrudController::class);
        yield MenuItem::linkToDashboard(t('Options', [], 'menu'), 'fa fa-sliders');
    }
}
