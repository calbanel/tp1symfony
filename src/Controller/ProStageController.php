<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;
use App\Repository\StageRepository;

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

    public function affichageFormulaireCreationEntreprise()
    {
        $entreprise = new Entreprise();

        $formulaireEntreprise = $this->createFormBuilder($entreprise)
                                    ->add('nom')
                                    ->add('activite')
                                    ->add('adresse')
                                    ->add('email')
                                    ->add('siteWeb')
                                    ->getForm()
                                    ;


        $vueFormulaireEntreprise = $formulaireEntreprise->createView();

        return $this->render('pro_stage/formulaireEntreprise.html.twig', ['vueFormulaireEntreprise' => $vueFormulaireEntreprise]);
    }



}


