<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Genre;
use App\Repository\AlbumRepository;
use App\Repository\ArtistRepository;
use App\Repository\GenreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SpecificController extends AbstractController
{
    #[Route('/artists/{id}', name: 'artists')]
    public function artists(Artist $artist): Response
    {
        return $this->render('specific/artists.html.twig', [
            'controller_name' => 'SpecificController',
            'artist' => $artist
        ]);
    }

    #[Route('/albums/{id}', name: 'albums')]
    public function albums(Album $album): Response
    {
        return $this->render('specific/albums.html.twig', [
            'controller_name' => 'SpecificController',
            'album' => $album
        ]);
    }

    #[Route('/genres/{id}', name: 'genres')]
    public function genres(Genre $genre): Response
    {
        return $this->render('specific/genres.html.twig', [
            'controller_name' => 'SpecificController',
            'genre'=>$genre
        ]);
    }
}
