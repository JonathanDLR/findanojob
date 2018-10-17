<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetenceRepository")
 */
class Competence
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
    private $nom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $niveau;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\StagiaireCompetence", mappedBy="competence")
     */
    private $stagiaireCompetences;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OffreCompetence", mappedBy="competence")
     */
    private $offreCompetences;

    public function __construct()
    {
        $this->stagiaireCompetences = new ArrayCollection();
        $this->offreCompetences = new ArrayCollection();
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

    public function getNiveau(): ?int
    {
        return $this->niveau;
    }

    public function setNiveau(?int $niveau): self
    {
        $this->niveau = $niveau;

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
            $stagiaireCompetence->setCompetence($this);
        }

        return $this;
    }

    public function removeStagiaireCompetence(StagiaireCompetence $stagiaireCompetence): self
    {
        if ($this->stagiaireCompetences->contains($stagiaireCompetence)) {
            $this->stagiaireCompetences->removeElement($stagiaireCompetence);
            // set the owning side to null (unless already changed)
            if ($stagiaireCompetence->getCompetence() === $this) {
                $stagiaireCompetence->setCompetence(null);
            }
        }

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
            $offreCompetence->setCompetence($this);
        }

        return $this;
    }

    public function removeOffreCompetence(OffreCompetence $offreCompetence): self
    {
        if ($this->offreCompetences->contains($offreCompetence)) {
            $this->offreCompetences->removeElement($offreCompetence);
            // set the owning side to null (unless already changed)
            if ($offreCompetence->getCompetence() === $this) {
                $offreCompetence->setCompetence(null);
            }
        }

        return $this;
    }
}
