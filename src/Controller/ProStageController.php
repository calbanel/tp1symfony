<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProStageController extends AbstractController
{
    /**
     * @Route("/", name="pro_stage")
     */
    public function index()
    {
        return $this->render('pro_stage/index.html.twig', [
            'controller_name' => 'ProStageController',
        ]);
    }

    /**
     * @Route("/entreprises", name="pro_stage")
     */
    public function entreprises()
    {
        return $this->render('pro_stage/entreprises.html.twig', [
            'controller_name' => 'ProStageController',
        ]);
    }

    /**
     * @Route("/formations", name="pro_stage")
     */
    public function formations()
    {
        return $this->render('pro_stage/formations.html.twig', [
            'controller_name' => 'ProStageController',
        ]);
    }
}


