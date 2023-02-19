<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;

class UsersController extends AbstractController
{
    #[Route('/users', name: 'users')]
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(Users::class)->findAll();

        return $this->render('home/index.html.twig', [
            'users' => $users,
        ]);
    }

    public function add(Request $request): Response
    {
        $user = new User();

        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'User added successfully.');

            return $this->redirectToRoute('user_list');
        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
