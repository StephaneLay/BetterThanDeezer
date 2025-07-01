<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use App\Repository\ArtistRepository;
use App\Repository\GenreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SpecificController extends AbstractController
{
    #[Route('/artists/{id}', name: 'artists')]
    public function artists(ArtistRepository $artistRepository,int $id): Response
    {
        $artist = $artistRepository->find($id);
        return $this->render('specific/artists.html.twig', [
            'controller_name' => 'SpecificController',
            'artist' => $artist
        ]);
    }

    #[Route('/albums/{id}', name: 'albums')]
    public function albums(AlbumRepository $albumRepository,int $id): Response
    {
        $album = $albumRepository->find($id);
        return $this->render('specific/albums.html.twig', [
            'controller_name' => 'SpecificController',
            'album' => $album
        ]);
    }

    #[Route('/genres/{id}', name: 'genres')]
    public function genres(GenreRepository $genreRepository,int $id): Response
    {
        $genre = $genreRepository->find($id);
        return $this->render('specific/genres.html.twig', [
            'controller_name' => 'SpecificController',
            'genre'=>$genre
        ]);
    }
}
