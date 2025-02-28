<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurEditType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

final class CompteController extends AbstractController{
    public function __construct(private UserPasswordHasherInterface $hasher) {}
    #[Route('/compte', name: 'app_compte')]
    public function index(): Response
    {
        return $this->render('compte/index.html.twig', [
            'controller_name' => 'CompteController',
        ]);
    }

    #[Route('/compte/delete/{id}', name: 'app_compte_delete')]
    public function delete(Utilisateur $abonne, EntityManagerInterface $em,TokenStorageInterface $tokenStorage, Request $req): Response
    {
        if ($this->getUser() === $abonne) {
            $tokenStorage->setToken(null);
            $req->getSession()->invalidate();
        }
        $em->remove($abonne);
        $em->flush();
        return $this->redirectToRoute('app_landing');
    }

    #[Route('/compte/edit/{id}', name: 'app_compte_edit', methods: ['GET', 'POST', 'PUT', 'PATCH'])]
    public function edit(Utilisateur $abonne,EntityManagerInterface $em, Request $req): Response
    {
        $form = $this->createForm(UtilisateurEditType::class, $abonne);
        $form->handleRequest($req);
        if ($form->isSubmitted() and $form->isValid()) {
            $abonne = $form->getData();
            $abonne->setPassword(
                $this->hasher->hashPassword($abonne, $abonne->getPassword())
            );
            $em->flush();
            return $this->redirectToRoute('app_compte');
        }
        return $this->render('compte/edit.html.twig', [
            'controller_name' => 'CompteController',
            'form' => $form
        ]);
    }
}
