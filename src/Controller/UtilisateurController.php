<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurInsertType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UtilisateurController extends AbstractController{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    #[Route('/utilisateur/new', name: 'app_utilisateur_new', methods: ['GET', 'POST'])]
    public function new(EntityManagerInterface $em, Request $req): Response
    {
        $abonne = new Utilisateur();
        $abonne->setRoles(['ROLE_USER']);
        $form = $this->createForm(UtilisateurInsertType::class, $abonne);
        $form->handleRequest($req);
        if ($form->isSubmitted() and $form->isValid()) {
            $abonne = $form->getData();
            $abonne->setPassword(
                $this->hasher->hashPassword($abonne, $abonne->getPassword())
            );
            $em->persist($abonne);
            $em->flush();
            return $this->redirectToRoute('app_login');
        }
        return $this->render('utilisateur/new.html.twig', [
            'controller_name' => 'UtilisateurController',
            'form' => $form
        ]);
    }
}
