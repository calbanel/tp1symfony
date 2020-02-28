<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;
use App\Entity\User;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

    	$faker = \Faker\Factory::create('fr_FR');

        $user1 = new User();
        $user1->setUsername("clement");
        $roles[] =  'ROLE_ADMIN';
        $user1->setRoles($roles);
        $user1->setPassword("clement");

        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername("random");
        $roles2[] =  'ROLE_USER';
        $user2->setRoles($roles2);
        $user2->setPassword("random");

        $manager->persist($user2);


        $info = new Formation();
        $info->setNomCourt("DUT Informatique");
        $info->setNomLong("Diplome Universitaire Technologique en Informatique");

        $mmi = new Formation();
        $mmi->setNomCourt("DUT MMI");
        $mmi->setNomLong("Diplome Universitaire Technologique des Métiers du Multimédia et de l'Informatique");

        $gym = new Formation();
        $gym->setNomCourt("DUT GIM");
        $gym->setNomLong("Diplome Universitaire Technologique en Génie? Industriel et Maintenance");

        $tabFormations = array($info,$mmi,$gym);
        foreach ($tabFormations as $formation) {
            $manager->persist($formation);
        }


        $tabEntreprises = array();
        for ($i=0; $i < 8; $i++) {
            $entreprise = new Entreprise();
            $entreprise->setNom($faker->company)
                ->setActivite($faker->realText($maxNbChars = 200, $indexSize = 2))
                ->setAdresse($faker->address)
                ->setSiteWeb($faker->url)
                ->setEmail($faker->companyEmail)
            ;
            array_push($tabEntreprises, $entreprise);
            $manager->persist($entreprise);
        }

        for ($i=0; $i < 50; $i++) {
            $stage = new Stage();
            $stage->setTitre($faker->catchPhrase)
                ->setDescription($faker->realText($maxNbChars = 200, $indexSize = 2))
                ->setEmail($faker->email)
            ;

            $entrep= $faker->randomElement($array = $tabEntreprises);
            $stage->setEntreprise($entrep);
            $entrep->addStage($stage);
            $manager->persist($entrep);

            $nbFormation = $faker->numberBetween($min = 1, $max = 3);
            for ($j=0; $j < $nbFormation; $j++) { 
                $stage->addFormation($tabFormations[$j]);
                $tabFormations[$j]->addStage($stage);
                $manager->persist($tabFormations[$j]);
            }
            
            
            $manager->persist($stage);
        }

        $manager->flush();
    }
}
