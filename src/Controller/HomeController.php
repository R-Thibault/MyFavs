<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchDataForm;
use App\Repository\TagsRepository;
use App\Repository\FavCardsPublicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(FavCardsPublicRepository $favCardsPublicRepository, Request $request): Response
    {
        $data = new SearchData();
        $form = $this->createForm(SearchDataForm::class, $data);
        $form->handleRequest($request);


        $cardsPublic = $favCardsPublicRepository->findSearch($data);
        
        return $this->render('home/index.html.twig', [
            'cardsPublic' => $cardsPublic,
            'form' => $form->createView(),
        ]);
    }
}
