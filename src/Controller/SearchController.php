<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\Type\SearchType;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function searchFunc(Request $request): response
    {
        $formSearching = $this->createForm(SearchType::class);
        $region = $this->getDoctrine()->getRepository('App:Stagiaire')->findRegion();
        $formSearching->handleRequest($request);

        if($formSearching->isSubmitted() && $formSearching->isValid()) {
            $regionSearch = $request->request->get('region');
            $dateDebut = $request->request->get('dateDebut');
            $searchStagiaire = $this->getDoctrine()->getRepository('App:Stagiaire')->findStagiaire($regionSearch);
            return $this->render('resultsearch.html.twig', [
                'results' => $searchStagiaire
            ]);
        }

        return $this->render('searching.html.twig', [
            'formSearching' => $formSearching->createView(),
            'regions' => $region
        ]);
    }

}

?>