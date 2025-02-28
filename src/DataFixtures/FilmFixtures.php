<?php

namespace App\DataFixtures;

use App\Entity\Film;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FilmFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // premier pseudo-film
        $film1 = new Film();
        $film1->setTitre("Calvaire");
        $film1->setImage("juste une url à trouver");
        $film1->setGenre("horreur");
        $film1->setDescription("Un magicien fauché est hébergé par des campagnards chelous. C'est mal barré pour lui. ");
        $film1->setDateSortie(new DateTime());
        $manager->persist($film1);

        $manager->flush();
    }
}
