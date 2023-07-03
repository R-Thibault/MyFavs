<?php

namespace App\Controller;

use App\Repository\TagsRepository;
use App\Repository\FavCardsPublicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(FavCardsPublicRepository $favCardsPublicRepository): Response
    {
        $cardsPublic = $favCardsPublicRepository->findAll();

        return $this->render('home/index.html.twig', compact('cardsPublic'));
    }
}
