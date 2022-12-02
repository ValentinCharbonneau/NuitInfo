<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\MST;
use App\Repository\MSTRepository;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(MSTRepository $mSTRepository): Response
    {
        $msts = $mSTRepository->findAll();

        $mst = $msts[rand(0, 6)];

        return $this->render('default/pardon.html.twig', ['mst' => $mst]);
    }

    // #[Route('/presentation', name: 'app_presentation')]
    public function presentation(MSTRepository $mSTRepository): Response
    {
        $msts = $mSTRepository->findAll();

        $mst = $msts[rand(0, 6)];

        return $this->render('default/presentation.html.twig', ['mst' => $mst]);
    }
}
