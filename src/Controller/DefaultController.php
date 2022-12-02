<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\MST;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/default', name: 'app_default')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }
    #[Route('/presentation', name: 'app_presentation')]
    public function presentation(ManagerRegistry $doctrine): Response
    {
        $number = rand(1,7);
        $mst = $doctrine->getRepository(MST::class)->find($number);


        return $this->render('default/presentation.html.twig', [
            "mst" => $mst
        ]);
    }
    
}
