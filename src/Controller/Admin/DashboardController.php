<?php

namespace App\Controller\Admin;

use App\Entity\Adherent;
use App\Entity\Cotisation;
use App\Entity\Don;
use App\Entity\DroitAdhesion;
use App\Entity\Fonction;
use App\Entity\Service;
use App\Entity\SiteAdherent;
use App\Entity\StatutAdherent;
use App\Entity\TypeDon;
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
//        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
//        return $this->redirect($adminUrlGenerator->setController(FonctionCrudController::class)->generateUrl());
        

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
         return $this->render('dashboard/index.html.twig');
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
        yield MenuItem::linkToCrud('Cotisation', 'fa-solid fa-hand-holding-dollar', Cotisation::class);
        yield MenuItem::linkToCrud('Adhesion','fa-solid fa-address-card' , DroitAdhesion::class);

        yield MenuItem::subMenu('Dons','fa-solid fa-hand-holding-medical')->setSubItems([
            MenuItem::linkToCrud('Liste des dons', 'fas fa-list', Don::class),
            MenuItem::linkToCrud('Faire un don', 'fa-solid fa-circle-plus', Don::class)->setAction('new'),
            MenuItem::linkToCrud('Type de dons', 'fas fa-list', TypeDon::class),
        ]);


        yield MenuItem::subMenu('Informations', 'fa fa-circle-info')->setSubItems([
            MenuItem::linkToCrud('Fonctions', 'fa-solid fa-briefcase', Fonction::class),
            MenuItem::linkToCrud('Service', 'fa-solid fa-building-flag', Service::class),
            MenuItem::linkToCrud('Site', 'fa-solid fa-location-dot', SiteAdherent::class),
            MenuItem::linkToCrud('Statut', 'fa-solid fa-person-circle-question', StatutAdherent::class),
        ]);
    }


}
