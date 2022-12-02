<?php

namespace App\Controller;

use App\Entity\Testimony;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestimonyController extends AbstractController
{
    #[Route('/temoigner', name: 'app_testimony')]
    public function index(): Response
    {
        return $this->render('testimony/index.html.twig');
    }

    #[Route('/temoignages', name: 'app_approval')]
    public function approval(): Response
    {
        $test = [];
        return $this->render('testimony/approval.html.twig', [
            'temoignages' => $test,
        ]);
    }
}
