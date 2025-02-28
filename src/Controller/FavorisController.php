<?php

namespace App\Controller;

use App\Repository\FilmUtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FavorisController extends AbstractController{
    #[Route('/favoris', name: 'app_favoris')]
    public function index(FilmUtilisateurRepository $repo): Response
    {
        return $this->render('favoris/index.html.twig', [
            'controller_name' => 'FavorisController',
            'favoris' => $repo->findAll()
        ]);
    }
}
