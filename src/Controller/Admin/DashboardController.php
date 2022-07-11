<?php

namespace App\Controller\Admin;

use App\Entity\Quest;
use App\Entity\Trader;
use App\Entity\User;
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

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Eft Site')
            ->renderContentMaximized()
            ->disableUrlSignatures()
            ->generateRelativeUrls()
            ->setTranslationDomain('admin');
            ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard');
        yield MenuItem::section('Наполнение', '');
        yield MenuItem::linkToCrud(t('Quests'), 'fa fa-location-question', Quest::class)->setController(QuestCrudController::class);
        yield MenuItem::linkToCrud(t('Traders'), '', Trader::class)->setController(TraderCrudController::class);
        yield MenuItem::linkToDashboard(t('Updates'), 'fa fa-home');
        yield MenuItem::linkToDashboard(t('Tips'), 'fa fa-home');
        yield MenuItem::linkToDashboard(t('Items'), 'fa fa-home');
        yield MenuItem::section('Материалы', '');
        yield MenuItem::linkToDashboard(t('Photos'), 'fa fa-user-gear');
        yield MenuItem::linkToDashboard(t('Videos'), 'fa fa-sliders');
        yield MenuItem::section('Управление', '');
        yield MenuItem::linkToCrud(t('Users'), 'fa fa-user-gear', User::class)->setController(UserCrudController::class);
        yield MenuItem::linkToDashboard(t('Options'), 'fa fa-sliders');
    }
}
