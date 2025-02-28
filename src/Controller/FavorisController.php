<?php

namespace App\Controller;

use App\Entity\FilmUtilisateur;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\FilmUtilisateurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class FavorisController extends AbstractController{
    #[Route('/favoris', name: 'app_favoris')]
    public function index(FilmUtilisateurRepository $repo): Response
    {
        return $this->render('favoris/index.html.twig', [
            'controller_name' => 'FavorisController',
            'favoris' => $repo->findAll()
        ]);
    }

    #[Route('/favoris/delete/{id}', name: 'app_favoris_delete')]
    public function delete(FilmUtilisateur $film, EntityManagerInterface $em): Response
    {
        $em->remove($film);
        $em->flush();
        return $this->redirectToRoute('app_favoris');
    }
}
