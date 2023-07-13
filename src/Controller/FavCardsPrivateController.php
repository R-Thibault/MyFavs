<?php

namespace App\Controller;

use App\Entity\FavCardsPrivate;
use App\Data\SearchData;
use App\Form\SearchDataForm;
use App\Entity\FavCardsPublic;
use App\Form\FavCardsPrivateType;
use App\Form\CardRequestFormType;
use App\Repository\UsersRepository;
use App\Repository\FavCardsPrivateRepository;
use App\Repository\FavCardsPublicRepository;
use App\Repository\TagsRepository;
use Doctrine\ORM\EntityManager;
use App\Dto\ValueObject;
use App\Dto\ValueObjectPublicProperties;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use stdClass;
use Symfony\Component\HttpFoundation\Request;

#[Route('/fav/cards/private', name: 'app_fav_cards_private')]
class FavCardsPrivateController extends AbstractController
{
    #[Route('/display', name: '_display', methods: ['GET'])]
    public function display(FavCardsPrivateRepository $favCardsPrivateRepository, Request $request): Response
    {
        $user = $this->getUser();
        // $cardsPrivate= $favCardsPrivateRepository->findBy(['Author' => $user]);
        
        $data = new SearchData();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchDataForm::class, $data);
        $form->handleRequest($request);


        $favCardsPrivate = $favCardsPrivateRepository->findSearch($data, $user);
        

        if($request->get('ajax'))
        {
            return new JsonResponse([
                'content' => $this->renderView('fav_cards_private/_gallery.html.twig', ['favCardsPrivate' => $favCardsPrivate]),
                'pagination' => $this->renderView('fav_cards_private/_pagination.html.twig', ['favCardsPrivate' => $favCardsPrivate]),
                'sorting' => $this->renderView('fav_cards_private/_sorting.html.twig', ['favCardsPrivate' => $favCardsPrivate]),
            ]);
        }
        return $this->render('fav_cards_private/display.html.twig', [
            'favCardsPrivate' => $favCardsPrivate,
            'user' => $user,
            //  'cardsPrivate' => $cardsPrivate,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/', name: '_index', methods: ['GET'])]
    public function index(FavCardsPrivateRepository $favCardsPrivateRepository): Response
    {
        $user = $this->getUser();
        $cardsPrivate= $favCardsPrivateRepository->findBy(['Author' => $user]);
        return $this->render('fav_cards_private/index.html.twig', compact('cardsPrivate'));
    }

    #[Route('/new', name: '_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FavCardsPrivateRepository $favCardsPrivateRepository, EntityManagerInterface $entityManager, UsersRepository $usersRepository): Response
    {
        $favCardsPrivate = new FavCardsPrivate();
        $form = $this->createForm(FavCardsPrivateType::class, $favCardsPrivate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($favCardsPrivate);
            $entityManager->flush();

            return $this->redirectToRoute('app_fav_cards_private_index', [], Response::HTTP_SEE_OTHER);
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
    public function edit(Request $request, FavCardsPrivate $favCardsPrivate, TagsRepository $tagsRepository, EntityManagerInterface $entityManager, FavCardsPrivateRepository $favCardsPrivateRepository): Response
    {
        // $favCardsPrivate = $favCardsPrivateRepository->findSearch();

        $form = $this->createForm(FavCardsPrivateType::class, $favCardsPrivate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($favCardsPrivate);
            $entityManager->flush();

            return $this->redirectToRoute('app_fav_cards_private_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fav_cards_private/edit.html.twig', [
            'fav_cards_private' => $favCardsPrivate,
            // 'Tag' => $Tag,
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
