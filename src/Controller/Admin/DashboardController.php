<?php

namespace App\Controller\Admin;

use App\Entity\Adherent;
use App\Entity\Fonction;
use App\Entity\Service;
use App\Entity\SiteAdherent;
use App\Entity\StatutAdherent;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Menu\SubMenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(FonctionCrudController::class)->generateUrl());
        

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
            ->setTitle('CaisseSolidarite');
    }

    public function configureMenuItems(): iterable
    {
        
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::linkToCrud('Adherent', 'fas fa-people-group', Adherent::class);

        yield MenuItem::subMenu('Infos', 'fa fa-list')->setSubItems([
            MenuItem::linkToCrud('Fonctions', 'fas fa-list', Fonction::class),
            MenuItem::linkToCrud('Service', 'fas fa-list', Service::class),
            MenuItem::linkToCrud('SiteAadherent', 'fas fa-list', SiteAdherent::class),
            MenuItem::linkToCrud('StatutAdherent', 'fas fa-list', StatutAdherent::class),
        ]);
    }
}