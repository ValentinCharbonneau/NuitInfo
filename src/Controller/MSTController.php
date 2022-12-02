<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\MST;
use App\Form\MSTType;
use App\Repository\MSTRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/m/s/t')]
class MSTController extends AbstractController
{
    #[Route('/', name: 'app_m_s_t_index', methods: ['GET'])]
    public function index(ManagerRegistry $doctrine): Response
    {
        $mst = $doctrine->getRepository(MST::class)->findAll();


        return $this->render('default/index.html.twig', [
            "mst" => $mst
        ]);
    }

    #[Route('/new', name: 'app_m_s_t_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MSTRepository $mSTRepository): Response
    {
        if(!$this->isGranted('ROLE_ADMIN'))
        {
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }
        $mST = new MST();
        $form = $this->createForm(MSTType::class, $mST);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mSTRepository->save($mST, true);

            return $this->redirectToRoute('app_m_s_t_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mst/new.html.twig', [
            'm_s_t' => $mST,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_m_s_t_show', methods: ['GET'])]
    public function show(MST $mST): Response
    {
        return $this->render('mst/show.html.twig', [
            'm_s_t' => $mST,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_m_s_t_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MST $mST, MSTRepository $mSTRepository): Response
    {
        if(!$this->isGranted('ROLE_ADMIN'))
        {
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }
        $form = $this->createForm(MSTType::class, $mST);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mSTRepository->save($mST, true);

            return $this->redirectToRoute('app_m_s_t_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mst/edit.html.twig', [
            'm_s_t' => $mST,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_m_s_t_delete', methods: ['POST'])]
    public function delete(Request $request, MST $mST, MSTRepository $mSTRepository): Response
    {
        if(!$this->isGranted('ROLE_ADMIN'))
        {
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }
        if ($this->isCsrfTokenValid('delete'.$mST->getId(), $request->request->get('_token'))) {
            $mSTRepository->remove($mST, true);
        }

        return $this->redirectToRoute('app_m_s_t_index', [], Response::HTTP_SEE_OTHER);
    }
}
