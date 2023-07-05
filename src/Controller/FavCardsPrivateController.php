<?php

namespace App\Controller;

use App\Entity\FavCardsPrivate;
use App\Form\FavCardsPrivateType;
use App\Repository\FavCardsPrivateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/fav/cards/private', name: 'app_fav_cards_private')]
class FavCardsPrivateController extends AbstractController
{
    #[Route('/display', name: '_display', methods: ['GET'])]
    public function display(FavCardsPrivateRepository $favCardsPrivateRepository): Response
    {
        $user = $this->getUser();
        $cardsPrivate= $favCardsPrivateRepository->findBy(['Author' => $user]);
        return $this->render('fav_cards_private/display.html.twig', compact('cardsPrivate'));
    }

    #[Route('/', name: '_index', methods: ['GET'])]
    public function index(FavCardsPrivateRepository $favCardsPrivateRepository): Response
    {
        $user = $this->getUser();
        $cardsPrivate= $favCardsPrivateRepository->findBy(['Author' => $user]);
        return $this->render('fav_cards_private/index.html.twig', compact('cardsPrivate'));
    }

    #[Route('/new', name: '_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FavCardsPrivateRepository $favCardsPrivateRepository): Response
    {
        $favCardsPrivate = new FavCardsPrivate();
        $form = $this->createForm(FavCardsPrivateType::class, $favCardsPrivate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $favCardsPrivateRepository->save($favCardsPrivate, true);

            return $this->redirectToRoute('_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fav_cards_private/new.html.twig', [
            'fav_cards_private' => $favCardsPrivate,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: '_show', methods: ['GET'])]
    public function show(FavCardsPrivate $favCardsPrivate): Response
    {
        return $this->render('fav_cards_private/show.html.twig', [
            'fav_cards_private' => $favCardsPrivate,
        ]);
    }

    #[Route('/{id}/edit', name: '_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FavCardsPrivate $favCardsPrivate, FavCardsPrivateRepository $favCardsPrivateRepository): Response
    {
        $form = $this->createForm(FavCardsPrivateType::class, $favCardsPrivate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $favCardsPrivateRepository->save($favCardsPrivate, true);

            return $this->redirectToRoute('app_fav_cards_private_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fav_cards_private/edit.html.twig', [
            'fav_cards_private' => $favCardsPrivate,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: '_delete', methods: ['POST'])]
    public function delete(Request $request, FavCardsPrivate $favCardsPrivate, FavCardsPrivateRepository $favCardsPrivateRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$favCardsPrivate->getId(), $request->request->get('_token'))) {
            $favCardsPrivateRepository->remove($favCardsPrivate, true);
        }

        return $this->redirectToRoute('app_fav_cards_private_index', [], Response::HTTP_SEE_OTHER);
    }
}
