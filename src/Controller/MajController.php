<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Type\StagiaireType;
use App\Form\Handler\MajStagiaireHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MajController extends AbstractController
{
    /**
     * @Route("/account/{id}", name="account")
     */
    public function majstagiaire($id, MajStagiaireHandler $formHandler, Request $request): Response
    {
        $formStagMaj = $this->createForm(StagiaireType::class);
        $stagiaire = $this->getDoctrine()->getRepository('App:Stagiaire')->findOneBy([
            'user' => $id
            ]);
        

        if($formHandler->handle($formStagMaj, $request)) {
            return $this->redirectToRoute('index');
        }

        return $this->render('account.html.twig', [
            'formStagMaj' => $formStagMaj->createView(),
            'stagiaire' => $stagiaire
        ]);
    }
}
