<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Entreprise;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $entrepriseMCB = new Entreprise();
        $entrepriseMCB->setNom("MCB");
        $entrepriseMCB->setActivite("Que des bgs");
        $entrepriseMCB->setAdresse("10bis rue de mirambeau");
        $entrepriseMCB->setSiteWeb("www.mcblpb.com");
        $entrepriseMCB->setEmail("mcb@gmail.com");

        $manager->persist($entrepriseMCB);

        $manager->flush();
    }
}