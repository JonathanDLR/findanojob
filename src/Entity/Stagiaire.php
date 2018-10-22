<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StagiaireRepository")
 */
class Stagiaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    public $nom;

    /**
     * @ORM\Column(type="string", length=40)
     */
    public $prenom;

    /**
     * @ORM\Column(type="string", length=100)
     */
    public $adresse;

    /**
     * @ORM\Column(type="string", length=60)
     */
    public $ville;

    /**
     * @ORM\Column(type="string", length=60)
     */
    public $departement;

    /**
     * @ORM\Column(type="string", length=60)
     */
    public $region;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    public $date_debut;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    public $date_fin;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $age;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     */
    public $sexe;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    public $presentation;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    public $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\StagiaireCompetence", mappedBy="stagiaire")
     */
    public $stagiaireCompetences;

    public function __construct()
    {
        $this->stagiaireCompetences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(string $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(?\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(?\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(?string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|StagiaireCompetence[]
     */
    public function getStagiaireCompetences(): Collection
    {
        return $this->stagiaireCompetences;
    }

    public function addStagiaireCompetence(StagiaireCompetence $stagiaireCompetence): self
    {
        if (!$this->stagiaireCompetences->contains($stagiaireCompetence)) {
            $this->stagiaireCompetences[] = $stagiaireCompetence;
            $stagiaireCompetence->setStagiaire($this);
        }

        return $this;
    }

    public function removeStagiaireCompetence(StagiaireCompetence $stagiaireCompetence): self
    {
        if ($this->stagiaireCompetences->contains($stagiaireCompetence)) {
            $this->stagiaireCompetences->removeElement($stagiaireCompetence);
            // set the owning side to null (unless already changed)
            if ($stagiaireCompetence->getStagiaire() === $this) {
                $stagiaireCompetence->setStagiaire(null);
            }
        }

        return $this;
    }
}
