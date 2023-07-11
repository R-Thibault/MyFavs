<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchDataForm;
use App\Repository\TagsRepository;
use App\Repository\FavCardsPublicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(FavCardsPublicRepository $favCardsPublicRepository, Request $request): Response
    {
        $data = new SearchData();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchDataForm::class, $data);
        $form->handleRequest($request);


        $favCardsPublic = $favCardsPublicRepository->findSearch($data);
        if($request->get('ajax'))
        {
            return new JsonResponse([
                'content' => $this->renderView('home/_gallery.html.twig', ['favCardsPublic' => $favCardsPublic]),
                'pagination' => $this->renderView('home/_pagination.html.twig', ['favCardsPublic' => $favCardsPublic]),
                'sorting' => $this->renderView('home/_sorting.html.twig', ['favCardsPublic' => $favCardsPublic]),
            ]);
        }
        return $this->render('home/index.html.twig', [
            'favCardsPublic' => $favCardsPublic,
            'form' => $form->createView(),
        ]);
    }
}
