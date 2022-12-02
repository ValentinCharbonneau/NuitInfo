<?php

namespace App\Controller;

use App\Entity\Testimony;
use App\Form\TestimonyType;
use App\Repository\TestimonyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/testimony')]
class TestimonyController extends AbstractController
{
    #[Route('/', name: 'app_testimony', methods: ['GET'])]
    public function index(TestimonyRepository $testimonyRepository): Response
    {
        return $this->render('testimony/index.html.twig', [
            'testimonies' => $testimonyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_testimony', methods: ['GET', 'POST'])]
    public function new(Request $request, TestimonyRepository $testimonyRepository): Response
    {
        $testimony = new Testimony();
        $form = $this->createForm(TestimonyType::class, $testimony);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $testimonyRepository->save($testimony, true);

            return $this->redirectToRoute('app_testimony_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('testimony/new.html.twig', [
            'testimony' => $testimony,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testimony_show', methods: ['GET'])]
    public function show(Testimony $testimony): Response
    {
        return $this->render('testimony/show.html.twig', [
            'testimony' => $testimony,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_testimony_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Testimony $testimony, TestimonyRepository $testimonyRepository): Response
    {
        if(!$this->isGranted('ROLE_ADMIN'))
        {
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }
        $form = $this->createForm(TestimonyType::class, $testimony);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $testimonyRepository->save($testimony, true);

            return $this->redirectToRoute('app_testimony_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('testimony/edit.html.twig', [
            'testimony' => $testimony,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testimony_delete', methods: ['POST'])]
    public function delete(Request $request, Testimony $testimony, TestimonyRepository $testimonyRepository): Response
    {
        if(!$this->isGranted('ROLE_ADMIN'))
        {
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }
        if ($this->isCsrfTokenValid('delete'.$testimony->getId(), $request->request->get('_token'))) {
            $testimonyRepository->remove($testimony, true);
        }

        return $this->redirectToRoute('app_testimony_index', [], Response::HTTP_SEE_OTHER);
    }
}
