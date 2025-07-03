<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegisterForm;
use App\Mail\UserSubscribedConfirmation;
use App\Repository\GenreRepository;
use App\Repository\SongRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
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
    public function users(UserRepository $userRepository,Request $request,EntityManagerInterface $em,UserSubscribedConfirmation $userSubscribedConfirmation): Response
    {
        $users = $userRepository->findAll();
        $userSuscriber = new User();
        $userform = $this->createForm(UserRegisterForm::class,$userSuscriber);
        $userform->handleRequest($request);


        if ($userform->isSubmitted() && $userform->isValid()) {
            $em->persist($userSuscriber);
            $em->flush();

            $this->addFlash('success','Votre inscription a bien été prise en compte');

            $userSubscribedConfirmation->send($userSuscriber);
            
            return $this->redirectToRoute('users');
        }

        return $this->render('home/users.html.twig', [
            'controller_name' => 'HomeController',
            'users' => $users,
            'form'=>$userform
        ]);
    }


}
