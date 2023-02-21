<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Form\UsersType;
use App\Entity\Users;


class UsersController extends AbstractController
{
    #[Route('/users', name: 'users')]
    public function index()
    {
        $users = $this->getDoctrine()->getRepository(Users::class)->findAll();

        return $this->render('home/index.html.twig', [
            'users' => $users,
        ]);
    }
    
    #[Route('/users/add', name: 'users_add', methods: ['POST'])]
    public function addUser(Request $request)
    {
    // Get the form data
    $formData = $request->request->all();

    // Create a new User object
    $user = new Users();
    $user->setFirstName($formData['firstname']);
    $user->setLastName($formData['lastname']);
    $user->setCIN($formData['cin']);
    $user->setAddress($formData['address']);
    $user->setClubId($formData['clubid']);

    // Add the user to the database
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($user);
    $entityManager->flush();

    // Return a JSON response
    return $this->json([
        'status' => 'success',
        'message' => 'User added successfully.'
    ]);
    }

    #[Route('/users/delete/{id}', name: 'delete_user', methods: ['DELETE'])]
    public function deleteUser(Request $request): JsonResponse
    {
        $user = $this->getDoctrine()->getRepository(Users::class)->find($request->get('id'));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();

        return new JsonResponse(['message' => 'User deleted successfully.']);
    }
}
