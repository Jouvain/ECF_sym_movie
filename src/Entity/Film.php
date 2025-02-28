<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilmRepository::class)]
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $titre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateSortie = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $genre = null;

    /**
     * @var Collection<int, FilmUtilisateur>
     */
    #[ORM\OneToMany(targetEntity: FilmUtilisateur::class, mappedBy: 'miseEnFavoris')]
    private Collection $misesEnFavori;

    public function __construct()
    {
        $this->misesEnFavori = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->dateSortie;
    }

    public function setDateSortie(?\DateTimeInterface $dateSortie): static
    {
        $this->dateSortie = $dateSortie;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return Collection<int, FilmUtilisateur>
     */
    public function getMisesEnFavori(): Collection
    {
        return $this->misesEnFavori;
    }

    public function addMisesEnFavori(FilmUtilisateur $misesEnFavori): static
    {
        if (!$this->misesEnFavori->contains($misesEnFavori)) {
            $this->misesEnFavori->add($misesEnFavori);
            $misesEnFavori->setMiseEnFavoris($this);
        }

        return $this;
    }

    public function removeMisesEnFavori(FilmUtilisateur $misesEnFavori): static
    {
        if ($this->misesEnFavori->removeElement($misesEnFavori)) {
            // set the owning side to null (unless already changed)
            if ($misesEnFavori->getMiseEnFavoris() === $this) {
                $misesEnFavori->setMiseEnFavoris(null);
            }
        }

        return $this;
    }
}
