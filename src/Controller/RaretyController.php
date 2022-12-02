<?php

namespace App\Controller;

use App\Entity\Rarety;
use App\Form\RaretyType;
use App\Repository\RaretyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/rarety')]
class RaretyController extends AbstractController
{
    #[Route('/', name: 'app_rarety_index', methods: ['GET'])]
    public function index(RaretyRepository $raretyRepository): Response
    {
        return $this->render('rarety/index.html.twig', [
            'rareties' => $raretyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_rarety_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RaretyRepository $raretyRepository): Response
    {
        if(!$this->isGranted('ROLE_ADMIN'))
        {
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }
        $rarety = new Rarety();
        $form = $this->createForm(RaretyType::class, $rarety);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $raretyRepository->save($rarety, true);

            return $this->redirectToRoute('app_rarety_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rarety/new.html.twig', [
            'rarety' => $rarety,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rarety_show', methods: ['GET'])]
    public function show(Rarety $rarety): Response
    {
        return $this->render('rarety/show.html.twig', [
            'rarety' => $rarety,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_rarety_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Rarety $rarety, RaretyRepository $raretyRepository): Response
    {
        if(!$this->isGranted('ROLE_ADMIN'))
        {
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }
        $form = $this->createForm(RaretyType::class, $rarety);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $raretyRepository->save($rarety, true);

            return $this->redirectToRoute('app_rarety_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rarety/edit.html.twig', [
            'rarety' => $rarety,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rarety_delete', methods: ['POST'])]
    public function delete(Request $request, Rarety $rarety, RaretyRepository $raretyRepository): Response
    {
        if(!$this->isGranted('ROLE_ADMIN'))
        {
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }
        if ($this->isCsrfTokenValid('delete'.$rarety->getId(), $request->request->get('_token'))) {
            $raretyRepository->remove($rarety, true);
        }

        return $this->redirectToRoute('app_rarety_index', [], Response::HTTP_SEE_OTHER);
    }
}
