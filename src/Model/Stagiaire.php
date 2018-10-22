<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Stagiaire
{
    /**
     * @var string
     * @Assert\NotNull(message="Veuillez renseigner votre nom.")
     */
    public $nom;

    /**
     * @var string
     * @Assert\NotNull(message="Veuillez renseigner votre prenom.")
     */
    public $prenom;

    /**
     * @var string
     * @Assert\NotNull(message="Veuillez renseigner votre adresse.")
     */
    public $adresse;

    /**
     * @var string
     * @Assert\NotNull(message="Veuillez renseigner votre ville.")
     */
    public $ville;

    /**
     * @var string
     * @Assert\NotNull(message="Veuillez renseigner votre departement.")
     */
    public $departement;

    /**
     * @var string
     * @Assert\NotNull(message="Veuillez renseigner votre region.")
     */
    public $region;

    /**
     * @var string
     */
    public $date_debut;

    /**
     * @var string
     */
    public $date_fin;

    /**
     * @var integer
     */
    public $age;

    /**
     * @var string
     */
    public $sexe;

    /**
     * @var string
     */
    public $presentation;
}