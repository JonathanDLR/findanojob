<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OffreRepository")
 */
class Offre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_debut;

    /**
     * @ORM\Column(type="date")
     */
    private $date_fin;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbre_stagiaire;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptif;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entreprise", inversedBy="offres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entreprise;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OffreCompetence", mappedBy="offre")
     */
    private $offreCompetences;

    public function __construct()
    {
        $this->offreCompetences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getNbreStagiaire(): ?int
    {
        return $this->nbre_stagiaire;
    }

    public function setNbreStagiaire(int $nbre_stagiaire): self
    {
        $this->nbre_stagiaire = $nbre_stagiaire;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * @return Collection|OffreCompetence[]
     */
    public function getOffreCompetences(): Collection
    {
        return $this->offreCompetences;
    }

    public function addOffreCompetence(OffreCompetence $offreCompetence): self
    {
        if (!$this->offreCompetences->contains($offreCompetence)) {
            $this->offreCompetences[] = $offreCompetence;
            $offreCompetence->setOffre($this);
        }

        return $this;
    }

    public function removeOffreCompetence(OffreCompetence $offreCompetence): self
    {
        if ($this->offreCompetences->contains($offreCompetence)) {
            $this->offreCompetences->removeElement($offreCompetence);
            // set the owning side to null (unless already changed)
            if ($offreCompetence->getOffre() === $this) {
                $offreCompetence->setOffre(null);
            }
        }

        return $this;
    }
}
