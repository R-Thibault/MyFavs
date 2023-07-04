<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use App\Form\UserEditFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/account', name: 'app_account')]
class AccountController extends AbstractController
{
    #[Route('/account', name: '_index')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_home');
        }elseif ($this->getUser()->getRoles()[0] === 'ROLE_ADMIN') {
            return $this->redirectToRoute('admin');
        }

        $user = $this->getUser();
        
        return $this->render('account/index.html.twig', compact('user'));  

    }

    #[Route('/account/edit/{id}', name: '_edit')]
    public function edit(Users $user, Request $request, EntityManagerInterface $entityManagerInterface, UsersRepository $usersRepository ): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_home');
        }elseif ($this->getUser()->getRoles()[0] === 'ROLE_ADMIN') {
            return $this->redirectToRoute('app_admin');
        }
        $userEditForm = $this->createForm(UserEditFormType::class, $user);
        $userEditForm->handleRequest($request);

        
        if ($userEditForm->isSubmitted() && $userEditForm->isValid()) {
            $entityManagerInterface->persist($user);
            $entityManagerInterface->flush();
            $this->addFlash('success', 'Votre compte a bien été modifié');
            return $this->redirectToRoute('app_account_index');
        }

        
        
        return $this->render('account/edit.html.twig', [
            'user' => $user,
            'userEditForm' => $userEditForm->createView()
        ]);

    }
}

