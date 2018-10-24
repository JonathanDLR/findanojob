<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Type\SearchType;
use App\Entity\Stagiaire;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function searchFunc()
    {
        $formSearching = $this->createForm(SearchType::class);
        $region = $this->getDoctrine()->getRepository('App:Stagiaire')->findRegion();

        return $this->render('searching.html.twig', [
            'formSearching' => $formSearching->createView(),
            'regions' => $region
        ]);
    }
}
