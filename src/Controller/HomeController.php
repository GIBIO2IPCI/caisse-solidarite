<?php

namespace App\Controller;

use App\Repository\AdherentRepository;
use App\Repository\CotisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(AdherentRepository $adherentRepository, CotisationRepository $cotisationRepository): Response
    {
        $latestCotisations = $cotisationRepository->findLast5();


        $allAdherents = count($adherentRepository->findAll());
        $allAdherentsService = count($adherentRepository->findByStatus(1));
        $allAdherentsDepart = count($adherentRepository->findByStatus(2));
        $allAdherentsRetraite = count($adherentRepository->findByStatus(3));
        $allAdherentsHomme = count($adherentRepository->findBySexe(1));
        $allAdherentsFemme = count($adherentRepository->findBySexe(2));
        $allAdherentsInYear = count($adherentRepository->findByYear());
        $allAdherentsInMonth = count($adherentRepository->findByMonth());
        $allAdherentsInDay = count($adherentRepository->findByDay());

        $allCotisations = count($cotisationRepository->findAll());
        $allCotisationsInYear = count($cotisationRepository->findByYear());
        $allCotisationsInMonth = count($cotisationRepository->findByMonth());
        $allCotisationsInDay = count($cotisationRepository->findByDay());

        $sommeAllCotisations = $allCotisations * 1000;
        $sommeAllCotisationsInYear = $allCotisationsInYear * 1000;
        $sommeAllCotisationsInMonth = $allCotisationsInMonth * 1000;
        $sommeAllCotisationsInDay = $allCotisationsInDay * 1000;



        $sommeCaisse = $sommeAllCotisations;

        if (!$this->getUser()){
            return $this->redirectToRoute("app_login");
        }


        return $this->render('home/index.html.twig', [
            'latestCotisations' => $latestCotisations,

            'allAdherents' => $allAdherents,
            'allAdherentsService' => $allAdherentsService,
            'allAdherentsDepart' => $allAdherentsDepart,
            'allAdherentsRetraite' => $allAdherentsRetraite,
            'allAdherentsHomme' => $allAdherentsHomme,
            'allAdherentsFemme' => $allAdherentsFemme,
            'allAdherentsInYear' => $allAdherentsInYear,
            'allAdherentsInMonth' => $allAdherentsInMonth,
            'allAdherentsInDay' => $allAdherentsInDay,

            'allCotisations' => $allCotisations,
            'allCotisationsInYear' => $allCotisationsInYear,
            'allCotisationsInMonth' => $allCotisationsInMonth,
            'allCotisationsInDay' => $allCotisationsInDay,

            'sommeAllCotisations' => $sommeAllCotisations,
            'sommeAllCotisationsInYear' => $sommeAllCotisationsInYear,
            'sommeAllCotisationsInMonth' => $sommeAllCotisationsInMonth,
            'sommeAllCotisationsInDay' => $sommeAllCotisationsInDay,



            'sommeCaisse' => $sommeCaisse,

        ]);
    }
}
