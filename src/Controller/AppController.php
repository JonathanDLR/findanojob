<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AppController extends Controller
{
    /**
     * @Route("/ent_form", name="ent_form")
     */
    public function indexEnt(): Response
    {
        return $this->render('ent_form.html.twig');
    }

    /**
     * @Route("/stag_form", name="stag_form")
     */
    public function indexStag(): Response
    {
        return $this->render('stag_form.html.twig');
    }

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/result", name="result")
     * @Template("resultsearch.html.twig")
     */
    public function result()
    {        
    }
}