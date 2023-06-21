<?php

namespace App\DataFixtures;

use App\Entity\DroitAdhesion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
            for ($i = 1; $i <= 262; $i++) {
            $adhesion = new DroitAdhesion();
            $manager->persist($adhesion);
        }

        $manager->flush();

    }
}
