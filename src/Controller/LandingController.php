<?php

namespace App\Controller;

use App\Entity\Film;
use App\Form\FilmEditType;
use App\Form\FilmInsertType;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class LandingController extends AbstractController{
    
    #[Route('/landing', name: 'app_landing')]
    public function index(FilmRepository $films): Response
    {
        return $this->render('landing/index.html.twig', [
            'controller_name' => 'LandingController',
            'films' => $films->findAll()
        ]);
    }

    #[Route('/landing/new', name: 'app_landing_new', methods: ['GET', 'POST'])]
    public function new(EntityManagerInterface $em, Request $req): Response
    {
        $film = new Film();
        $form = $this->createForm(FilmInsertType::class, $film);
        $form->handleRequest($req);
        if ($form->isSubmitted() and $form->isValid()) {
            $film = $form->getData();
            $em->persist($film);
            $em->flush();
            return $this->redirectToRoute('app_landing');
        }
        return $this->render('landing/new.html.twig', [
            'controller_name' => 'LandingController',
            'form' => $form
        ]);
    }

    #[Route('/landing/delete/{id}', name: 'app_landing_delete')]
    public function delete(Film $film, EntityManagerInterface $em): Response
    {
        $em->remove($film);
        $em->flush();
        return $this->redirectToRoute('app_landing');
    }

    #[Route('/landing/edit/{id}', name: 'app_landing_edit', methods: ['GET', 'POST', 'PUT', 'PATCH'])]
    public function edit(Film $film,EntityManagerInterface $em, Request $req): Response
    {
        $form = $this->createForm(FilmEditType::class, $film);
        $form->handleRequest($req);
        if ($form->isSubmitted() and $form->isValid()) {
            $film = $form->getData();
            $em->flush();
            return $this->redirectToRoute('app_landing');
        }
        return $this->render('landing/edit.html.twig', [
            'controller_name' => 'LandingController',
            'form' => $form
        ]);
    }
}
