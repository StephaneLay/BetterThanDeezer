<?php

namespace App\Controller;

use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SpecificController extends AbstractController
{
    #[Route('/artists/{id}', name: 'artists')]
    public function artists(ArtistRepository $artistRepository,int $id): Response
    {
        return $this->render('specific/artists.html.twig', [
            'controller_name' => 'SpecificController',
        ]);
    }

    #[Route('/albums/{id}', name: 'albums')]
    public function albums(): Response
    {
        return $this->render('specific/albums.html.twig', [
            'controller_name' => 'SpecificController',
        ]);
    }

    #[Route('/genres/{id}', name: 'genres')]
    public function genres(): Response
    {
        return $this->render('specific/genres.html.twig', [
            'controller_name' => 'SpecificController',
        ]);
    }
}
