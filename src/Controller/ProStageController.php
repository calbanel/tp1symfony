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
        return $this->render('pro_stage/formations.html.twig');
    }

    public function stages($id)
    {
        $repositoryStage=$this->getDoctrine()->getRepository(Stage::class);
        $stage = $repositoryStage->find($id);
        return $this->render('pro_stage/stages.html.twig',
                                        ['stage'=>$stage]);
    }



}


