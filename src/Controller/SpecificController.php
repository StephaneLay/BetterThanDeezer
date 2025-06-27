<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SpecificController extends AbstractController
{
    #[Route('/artists', name: 'artists')]
    public function artists(): Response
    {
        return $this->render('specific/index.html.twig', [
            'controller_name' => 'SpecificController',
        ]);
    }

    #[Route('/albums', name: 'albums')]
    public function albums(): Response
    {
        return $this->render('specific/index.html.twig', [
            'controller_name' => 'SpecificController',
        ]);
    }

    #[Route('/genres', name: 'genres')]
    public function genres(): Response
    {
        return $this->render('specific/index.html.twig', [
            'controller_name' => 'SpecificController',
        ]);
    }
}
