<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AppController extends Controller
{
    /**
     * @Route("/", name="ent_form")
     */
    public function indexEnt(): Response
    {
        return $this->render('ent_form.html.twig');
    }

    /**
     * @Route("/", name="stag_form")
     */
    public function indexStag(): Response
    {
        return $this->render('stag_form.html.twig');
    }
}