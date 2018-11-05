<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Entreprise
{
    /**
     * @var string
     * @Assert\NotNull(message="Veuillez renseigner votre nom.")
     */
    public $nom;

    /**
     * @var integer
     * @Assert\NotNull(message="Veuillez renseigner votre siret.")
     */
    public $siret;

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
    public $presentation;
}