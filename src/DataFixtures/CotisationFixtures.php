<?php

namespace App\DataFixtures;

use App\Entity\Cotisation;
use App\Repository\CotisationRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CotisationFixtures extends Fixture
{
    public function __construct(private readonly CotisationRepository $cotisationRepository)
    {
    }


    public function load(ObjectManager $manager): void
    {
//        $adherent1 = $this->cotisationRepository->find(1);
//        $adherent2 = $this->cotisationRepository->find(2);
//
//         for ($i = 0; $i < 100; $i++) {
//             $cotisation = new Cotisation();
//             $cotisation->setDateCotisation(new \DateTime());
//             $cotisation->setAdherent($adherent1);
//             $manager->persist($cotisation);
//         }
//
//        for ($i = 0; $i < 100; $i++) {
//            $cotisation = new Cotisation();
//            $cotisation->setDateCotisation(new \DateTime());
//            $cotisation->setAdherent($adherent2);
//            $manager->persist($cotisation);
//        }
//
//        $manager->flush();
    }
}
