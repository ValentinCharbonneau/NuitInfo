<?php

namespace App\Controller;

use App\Entity\Cards;
use App\Form\CardsType;
use App\Repository\CardsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cards')]
class CardsController extends AbstractController
{
    #[Route('/', name: 'app_cards_index', methods: ['GET'])]
    public function index(CardsRepository $cardsRepository): Response
    {
        return $this->render('cards/index.html.twig', [
            'cards' => $cardsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cards_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CardsRepository $cardsRepository): Response
    {
        if(!$this->isGranted('ROLE_ADMIN'))
        {
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }
        $card = new Cards();
        $form = $this->createForm(CardsType::class, $card);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cardsRepository->save($card, true);

            return $this->redirectToRoute('app_cards_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cards/new.html.twig', [
            'card' => $card,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cards_show', methods: ['GET'])]
    public function show(Cards $card): Response
    {
        return $this->render('cards/show.html.twig', [
            'card' => $card,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cards_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cards $card, CardsRepository $cardsRepository): Response
    {
        if(!$this->isGranted('ROLE_ADMIN'))
        {
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }
        $form = $this->createForm(CardsType::class, $card);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cardsRepository->save($card, true);

            return $this->redirectToRoute('app_cards_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cards/edit.html.twig', [
            'card' => $card,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cards_delete', methods: ['POST'])]
    public function delete(Request $request, Cards $card, CardsRepository $cardsRepository): Response
    {
        if(!$this->isGranted('ROLE_ADMIN'))
        {
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }
        if ($this->isCsrfTokenValid('delete'.$card->getId(), $request->request->get('_token'))) {
            $cardsRepository->remove($card, true);
        }

        return $this->redirectToRoute('app_cards_index', [], Response::HTTP_SEE_OTHER);
    }
}
