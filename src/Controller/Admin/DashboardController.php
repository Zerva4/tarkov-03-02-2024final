<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Barter;
use App\Entity\Boss;
use App\Entity\Item\Item;
use App\Entity\Item\ItemCaliber;
use App\Entity\Item\ItemMaterial;
use App\Entity\Map;
use App\Entity\Quest\Quest;
use App\Entity\Quest\QuestItem;
use App\Entity\Trader\Trader;
use App\Entity\Trader\TraderCashOffer;
use App\Entity\Update\UpdateCategory;
use App\Entity\User;
use App\Entity\Workshop\Craft;
use App\Entity\Workshop\Place;
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
            MenuItem::linkToCrud(t('Common', [], 'menu'), '', Item::class)->setController(ItemCrudController::class)->setLinkRel('noreferrer'),
            MenuItem::linkToCrud(t('Quest', [], 'menu'), '', QuestItem::class)->setController(QuestItemCrudController::class)->setLinkRel('noreferrer'),
            MenuItem::linkToCrud(t('Materials', [], 'menu'), '', ItemMaterial::class)->setController(ItemMaterialCrudController::class)->setLinkRel('noreferrer'),
            MenuItem::linkToCrud(t('Calibers', [], 'menu'), '', ItemCaliber::class)->setController(ItemCaliberCrudController::class)->setLinkRel('noreferrer'),
            MenuItem::linkToCrud(t('Barters', [], 'menu'), '', Barter::class)->setController(BarterCrudController::class),
        ];
        $workshopMenu = [
            MenuItem::linkToCrud(t('Places', [], 'menu'), '', Place::class)->setController(PlaceCrudController::class),
            MenuItem::linkToCrud(t('Crafts', [], 'menu'), '', Craft::class)->setController(CraftCrudController::class),
        ];
        $tradersMenu = [
            MenuItem::linkToCrud(t('List', [], 'menu'), '', Trader::class)->setController(TraderCrudController::class),
            MenuItem::linkToCrud(t('Cash offers', [], 'menu'), '', TraderCashOffer::class)->setController(TraderCashOfferCrudController::class)
        ];
        $updatesMenu = [
            MenuItem::linkToCrud(t('List', [], 'menu'), '', UpdateCategory::class)->setController(UpdateCrudController::class),
            MenuItem::linkToCrud(t('Categories', [], 'menu'), '', UpdateCategory::class)->setController(UpdateCategoryCrudController::class)
        ];
        yield MenuItem::section(t('Content', [], 'menu'), '');
        yield MenuItem::linkToCrud(t('Maps', [], 'menu'), 'fa fa-map', Map::class)->setController(MapCrudController::class);
        yield MenuItem::subMenu(t('Traders', [], 'menu'), 'fa fa-cubes')->setSubItems($tradersMenu);
        yield MenuItem::subMenu(t('Items', [], 'menu'), 'fa fa-cubes')->setSubItems($itemsMenu);
        yield MenuItem::subMenu(t('Workshop', [], 'menu'), 'fa fa-cubes')->setSubItems($workshopMenu);
        yield MenuItem::linkToCrud(t('Quests', [], 'menu'), 'fa fa-question-circle', Quest::class)->setController(QuestCrudController::class);
        yield MenuItem::linkToCrud(t('Enemies', [], 'menu'), 'fa fa-skull', Boss::class)->setController(BossCrudController::class);
        yield MenuItem::subMenu(t('Updates', [], 'menu'), 'fa fa-sync')->setSubItems($updatesMenu);
        yield MenuItem::linkToCrud(t('Articles', [], 'menu'), 'fa fa-newspaper', Article::class)->setController(ArticleCrudController::class);
        yield MenuItem::section(t('Materials', [], 'menu'), '');
        yield MenuItem::linkToDashboard(t('Photos', [], 'menu'), 'fa fa-camera');
        yield MenuItem::linkToDashboard(t('Videos', [], 'menu'), 'fa fa-video-camera');
        yield MenuItem::section(t('Management', [], 'menu'), '');
        yield MenuItem::linkToCrud(t('Users', [], 'menu'), 'fa fa-user-gear', User::class)->setController(UserCrudController::class);
        yield MenuItem::linkToDashboard(t('Options', [], 'menu'), 'fa fa-sliders');
    }
}
