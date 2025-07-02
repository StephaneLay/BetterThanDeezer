<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegisterForm;
use App\Repository\GenreRepository;
use App\Repository\SongRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


final class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(SongRepository $songRepository): Response
    {
        $songs = $songRepository->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'songs' => $songs
        ]);
    }

     #[Route('/users', name: 'users')]
    public function users(UserRepository $userRepository,Request $request): Response
    {
        $users = $userRepository->findAll();
        $userSuscriber = new User();
        $userform = $this->createForm(UserRegisterForm::class,$userSuscriber);
        $userform->handleRequest($request);


        if ($userform->isSubmitted() && $userform->isValid()) {
            //PERSIST+FLUSH
        }

        return $this->render('home/users.html.twig', [
            'controller_name' => 'HomeController',
            'users' => $users,
            'form'=>$userform
        ]);
    }


}
