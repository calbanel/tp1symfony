<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;

class ProStageController extends AbstractController
{

    public function index()
    {
        $repositoryStage=$this->getDoctrine()->getRepository(Stage::class);
        $stages = $repositoryStage->findAll();

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
        return $this->render('pro_stage/affichageStageParEntreprise.html.twig', ['entreprise' => $entreprise]);
    }

    public function affichageStageParFormation($id)
    {
        $repositoryFormation=$this->getDoctrine()->getRepository(Formation::class);
        $formation = $repositoryFormation->find($id);
        return $this->render('pro_stage/affichageStageParFormation.html.twig', ['formation' => $formation]);
    }



}


