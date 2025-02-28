<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UtilisateurFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}
    public function load(ObjectManager $manager): void
    {
        // pseudo-admin en dur
        $admin = new Utilisateur();
        $admin->setEmail("admin@admin.fr");
        $admin->setNom("ADMINGUY");
        $admin->setPrenom("Admin");
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword(
            $this->hasher->hashPassword($admin, "admin")
        );
        $manager->persist($admin);

        // premier pseudo-abonne
        $abonne = new Utilisateur();
        $abonne->setEmail("user@user.fr");
        $abonne->setNom("MACKY");
        $abonne->setPrenom("Mac");
        $abonne->setRoles(['ROLE_USER']);
        $abonne->setPassword(
            $this->hasher->hashPassword($abonne, "user")
        );
        $manager->persist($abonne);

        $manager->flush();
    }
}
