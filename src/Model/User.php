<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class User
{
    /**
     * @var string
     * @Assert\NotNull(message="Veuillez renseigner votre user.")
     */
    public $username;

    /**
     * @var string
     * @Assert\Email(message="Veuillez renseigner un email valide.")
     */
    public $email;

    /**
     * @var string
     * @Assert\NotNull(message="Veuillez renseigner un mot de passe.")
     */
    public $password;

    public $userstatut;
}