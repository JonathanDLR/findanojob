<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Handler\StagiaireHandler;
use App\Form\Type\StagiaireType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\UserRepository;
use App\Entity\User;

class StagiaireController extends AbstractController
{
    /**
     * @Route("/stagiaire", name="stagiaire")
     */
    public function register(StagiaireHandler $formHandler, Request $request): Response
    {

        $formStag = $this->createForm(StagiaireType::class);
        
        

        if($formHandler->handle($formStag, $request)) {
            return $this->redirectToRoute('index');       
        }

        return $this->render('stag_form.html.twig', [
            'formStag' => $formStag->createView(),
        ]);
    }

    /**
     * @Route("/infostagiaire/{id}", name="infostagiaire")
     */
    public function infostagiaire($id): Response
    {
        $stagiaire = $this->getDoctrine()->getRepository('App:Stagiaire')->find($id);
        

        return $this->render('stag_infos.html.twig', [
            'stagiaire' => $stagiaire,
        ]);
    }
}
