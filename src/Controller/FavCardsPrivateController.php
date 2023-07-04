<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use App\Repository\FavCardsPrivateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavCardsPrivateController extends AbstractController
{
    #[Route('/fav/cards/private', name: 'app_fav_cards_private')]
    public function index(FavCardsPrivateRepository $favCardsPrivateRepository): Response
    {

        $user = $this->getUser();
        $cardsPrivate= $favCardsPrivateRepository->findBy(['Author' => $user]);
        
        return $this->render('fav_cards_private/index.html.twig', [
            'controller_name' => 'FavCardsPrivateController',
            'cardsPrivate' => $cardsPrivate,
        ]);
    }
}
