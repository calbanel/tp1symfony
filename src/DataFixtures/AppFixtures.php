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

    	$faker = \Faker\Factory::create('fr_FR');

        //$entrepriseMCB = new Entreprise();
        //$entrepriseMCB->setNom("MCB");
        //$entrepriseMCB->setActivite("Que des bgs");
        //$entrepriseMCB->setAdresse("10bis rue de mirambeau");
        //$entrepriseMCB->setSiteWeb("www.mcblpb.com");
        //$entrepriseMCB->setEmail("mcb@gmail.com");

        //$manager->persist($entrepriseMCB);

        $entreprise = [];
        for ($i=0; $i < 10; $i++) {
            $entreprise[$i] = new Entreprise();
            $entreprise[$i]->setNom($faker->company)
                ->setActivite($faker->realText($maxNbChars = 200, $indexSize = 2))
                ->setAdresse($faker->address)
                ->setSiteWeb($faker->url)
                ->setEmail($faker->companyEmail)
            ;
            $manager->persist($entreprise[$i]);
        }

        $manager->flush();
    }
}
