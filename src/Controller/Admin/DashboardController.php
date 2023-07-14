<?php

namespace App\Controller\Admin;

use App\Entity\Adherent;
use App\Entity\Assistance;
use App\Entity\AutreDepense;
use App\Entity\AutreEvenement;
use App\Entity\Cotisation;
use App\Entity\Don;
use App\Entity\DroitAdhesion;
use App\Entity\Evenement;
use App\Entity\Fonction;
use App\Entity\Fonctionnement;
use App\Entity\Service;
use App\Entity\SiteAdherent;
use App\Entity\StatutAdherent;
use App\Entity\TypeAssistance;
use App\Entity\TypeDon;
use App\Entity\TypeFonctionnement;
use App\Repository\AdherentRepository;
use App\Repository\AssistanceRepository;
use App\Repository\AutreDepenseRepository;
use App\Repository\CotisationRepository;
use App\Repository\DonRepository;
use App\Repository\DroitAdhesionRepository;
use App\Repository\FonctionnementRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    private AdherentRepository $adherentRepository;
    private AssistanceRepository $assistanceRepository;
    private CotisationRepository $cotisationRepository;
    private DonRepository $donRepository;
    private AutreDepenseRepository $autreDepenseRepository;
    private FonctionnementRepository $fonctionnementRepository;
    public function __construct(AdherentRepository $adherentRepository, AssistanceRepository $assistanceRepository, DonRepository $donRepository, CotisationRepository $cotisationRepository, AutreDepenseRepository $autreDepenseRepository, FonctionnementRepository $fonctionnementRepository)
    {
        $this->adherentRepository = $adherentRepository;
        $this->assistanceRepository = $assistanceRepository;
        $this->cotisationRepository = $cotisationRepository;
        $this->donRepository = $donRepository;
        $this->autreDepenseRepository = $autreDepenseRepository;
        $this->fonctionnementRepository = $fonctionnementRepository;
    }

    

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

        $total_adherent = count($this->adherentRepository->findAll());
        $total_adherent_annee = count($this->adherentRepository->findByDate());
        $adherent_homme = count($this->adherentRepository->findBySexe(2));
        $adherent_femme = count($this->adherentRepository->findBySexe(1));
        $adherent_fonction = count($this->adherentRepository->findByStatus(1));  //adherents en fonction
        $adherent_depart = count($this->adherentRepository->findByStatus(4));  //adherents partis
        $adherent_deces = count($this->adherentRepository->findByStatus(3)); 
        $adherent_retraite = count($this->adherentRepository->findByStatus(2)); //adherents décédé
        $total_assistance = $this->assistanceRepository->findAll();
        $total_assistance_mois = $this->assistanceRepository->findByDate();
        $total_autre_depense_mois = $this->autreDepenseRepository->findByDate();
        $total_don = $this->donRepository->findAll();
        $total_cotisation = $this->cotisationRepository->findAll();
        $total_autre_depense = $this->autreDepenseRepository->findAll();
        $total_fonctionnement = $this->fonctionnementRepository->findAll();

        

         return $this->render('dashboard/index.html.twig', [
            "nb_adherents" => $total_adherent,
            "nb_homme" => $adherent_homme,
            "nb_femme" => $adherent_femme,
            "adh_fonction" => $adherent_fonction,
            "adh_depart" => $adherent_depart,
            "adh_deces" => $adherent_deces,
            "adh_retraite" => $adherent_retraite,
            "total_assistance" => $total_assistance,
             "total_autre_depense" => $total_autre_depense,
             "total_autre_depense_mois" => $total_autre_depense_mois,
            "total_assistance_mois" => $total_assistance_mois,
            "nb_adherent_an" => $total_adherent_annee,
            "total_don" => $total_don,
            "total_cotisation" => $total_cotisation,
            "nb_cotisation" => count($total_cotisation),
            "nb_don" => count($total_don),
            "total_fonctionnement" => $total_fonctionnement,
         ]);
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
            MenuItem::linkToCrud('Type de dons', 'fa-solid fa-bars', TypeDon::class),
        ]);

        yield MenuItem::subMenu('Assistances','fa-solid fa-handshake-angle')->setSubItems([
            MenuItem::linkToCrud('Faire une assistance', 'fa-solid fa-hand-holding-heart', Assistance::class),
            MenuItem::linkToCrud('Assistance Exceptionnelle', 'fa-solid fa-tablets', AutreDepense::class),
            MenuItem::linkToCrud('Evenement', 'fa-brands fa-elementor', Evenement::class),
            MenuItem::linkToCrud('Evenement Exceptionnel', 'fa-solid fa-rectangle-list', AutreEvenement::class),
           
        ]);

            yield MenuItem::subMenu('Fonctionnement','fa-solid fa-hand-holding-medical')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fa-solid fa-circle-plus', Fonctionnement::class),
            MenuItem::linkToCrud('Type', 'fa-solid fa-up-down-left-right', TypeFonctionnement::class),
           
        ]);


        yield MenuItem::subMenu('Informations', 'fa fa-circle-info')->setSubItems([
            MenuItem::linkToCrud('Fonctions', 'fa-solid fa-briefcase', Fonction::class),
            MenuItem::linkToCrud('Service', 'fa-solid fa-building-flag', Service::class),
            MenuItem::linkToCrud('Site', 'fa-solid fa-location-dot', SiteAdherent::class),
            MenuItem::linkToCrud('Statut', 'fa-solid fa-person-circle-question', StatutAdherent::class),
        ]);
    }


}
