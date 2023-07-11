<?php

namespace App\Controller;

use App\Entity\FavCardsPrivate;
use App\Entity\FavCardsPublic;
use App\Form\CardRequestFormType;
use App\Repository\FavCardsPrivateRepository;
use App\Repository\FavCardsPublicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

#[Route('/fav/cards/public', name: 'app_fav_cards_public')]
class FavCardsPublicController extends AbstractController
{
    #[Route('/', name: '_index')]
    public function index(): Response
    {
    

        return $this->render('fav_cards_public/index.html.twig', [
            'controller_name' => 'FavCardsPublicController',
        ]);
    }

    #[Route('/{id}/request', name: '_request', methods: ['GET', 'POST'])]
    public function request(Request $request,FavCardsPrivate $favCardsPrivate,  FavCardsPublic $favCardsPublic, FavCardsPublicRepository $favCardsPublicRepository, FavCardsPrivateRepository $favCardsPrivateRepository, EntityManagerInterface $entityManagerInterface) : Response
    {
        $id = $favCardsPrivate->getId();
        $favCard = $favCardsPrivateRepository->findOneBy(['id' => $id]);
        //  $favCard = new FavCardsPublic();
         $favCardsPublic = new FavCardsPublic();
        
        $form = $this->createForm(CardRequestFormType::class, $favCardsPublic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManagerInterface->persist($favCardsPublic);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('app_fav_cards_private_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fav_cards_public/request.html.twig', [
            'favCardsPublic' => $favCardsPublic,
            'favCard' => $favCard,
            'form' => $form->createView(),
        ]);
    }
}
