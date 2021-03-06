<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;
use App\Entity\User;
use App\Form\EntrepriseType;
use App\Form\StageType;
use App\Form\UserType;
use App\Repository\StageRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

class ProStageController extends AbstractController
{

    public function index(StageRepository $repositoryStage)
    {

        //$stages = $repositoryStage->findAll();   9 requetes DB
        $stages = $repositoryStage->findAllStagesEntreprise();   // 1 requete DB

        return $this->render('pro_stage/index.html.twig', ['stages' => $stages]);
    }

    public function entreprises()
    {
        $repositoryEntreprise=$this->getDoctrine()->getRepository(Entreprise::class);
        $entreprises = $repositoryEntreprise->findAll();

        return $this->render('pro_stage/entreprises.html.twig', ['entreprises' => $entreprises]);
    }

    public function formations()
    {
        $repositoryFormation=$this->getDoctrine()->getRepository(Formation::class);
        $formations = $repositoryFormation->findAll();
        return $this->render('pro_stage/formations.html.twig', ['formations' => $formations]);
    }

    public function stages($id)
    {
        $repositoryStage=$this->getDoctrine()->getRepository(Stage::class);
        $stage = $repositoryStage->find($id);
        return $this->render('pro_stage/stages.html.twig',
                                        ['stage'=>$stage]);
    }

    public function affichageStageParEntreprise($id)
    {
        $repositoryEntreprise=$this->getDoctrine()->getRepository(Entreprise::class);
        $entreprise = $repositoryEntreprise->find($id);

        $repositoryStage=$this->getDoctrine()->getRepository(Stage::class);
        $stages = $repositoryStage->findStagesByNomEntreprise($entreprise->getNom());

        return $this->render('pro_stage/index.html.twig', ['stages' => $stages]);
    }

    public function affichageStageParFormation($id)
    {
        $repositoryFormation=$this->getDoctrine()->getRepository(Formation::class);
        $formation = $repositoryFormation->find($id);

        $repositoryStage=$this->getDoctrine()->getRepository(Stage::class);
        $stages = $repositoryStage->findStageByNomFormations($formation->getNomCourt());

        return $this->render('pro_stage/index.html.twig', ['stages' => $stages]);
    }

    public function affichageFormulaireCreationEntreprise(Request $requetteHttp, ObjectManager $manager)
    {
        $entreprise = new Entreprise();

        $formulaireEntreprise = $this->createForm(EntrepriseType::class,$entreprise);

        $formulaireEntreprise->handleRequest($requetteHttp);

        if($formulaireEntreprise->isSubmitted() && $formulaireEntreprise->isValid()){

            $manager->persist($entreprise);
            $manager->flush();

            return $this->redirectToRoute('entreprises');

        }

        return $this->render('pro_stage/formulaireEntreprise.html.twig',['vueFormulaireEntreprise' => $formulaireEntreprise->createView(), 'action'=>"ajout"]);
    }


    public function formulaireModifEntreprise(Request $request, ObjectManager $manager, Entreprise $entreprise)
    {

        $formulaireEntreprise = $this->createForm(EntrepriseType::class,$entreprise);

        $formulaireEntreprise->handleRequest($request);

         if ($formulaireEntreprise->isSubmitted() && $formulaireEntreprise->isValid())
         {

            $manager->persist($entreprise);
            $manager->flush();

            return $this->redirectToRoute('entreprises');
         }

        return $this->render('pro_stage/formulaireEntreprise.html.twig',['vueFormulaireEntreprise' => $formulaireEntreprise->createView(), 'action'=>"modifier"]);
    }

    public function affichageFormulaireCreationStage(Request $requetteHttp, ObjectManager $manager)
    {
        $stage = new Stage();

        $formulaireStage = $this->createForm(StageType::class,$stage);

        $formulaireStage->handleRequest($requetteHttp);

        if($formulaireStage->isSubmitted() && $formulaireStage->isValid()){

            $manager->persist($stage);
            $manager->flush();

            return $this->redirectToRoute('index');

        }

        return $this->render('pro_stage/formulaireStage.html.twig',['vueFormulaireStage' => $formulaireStage->createView()]);
    }

    public function affichageFormulaireInscription(Request $requetteHttp, ObjectManager $manager)
    {
        $user = new User();

        $formulaireUser = $this->createForm(UserType::class,$user);

        $formulaireUser->handleRequest($requetteHttp);

        if($formulaireUser->isSubmitted() && $formulaireUser->isValid()){

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('app_login');

        }

        return $this->render('pro_stage/inscription.html.twig',['vueFormulaireInscription' => $formulaireUser->createView()]);
    }



}


