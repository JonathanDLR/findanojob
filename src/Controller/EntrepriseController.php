<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Handler\EntrepriseHandler;
use App\Form\Type\EntrepriseType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\UserRepository;
use App\Entity\User;

class EntrepriseController extends AbstractController
{
    /**
     * @Route("/entreprise", name="entreprise")
     */
    public function register(EntrepriseHandler $formHandler, Request $request): Response
    {

        $formEnt = $this->createForm(EntrepriseType::class);
        
        

        if($formHandler->handle($formEnt, $request)) {
            return $this->redirectToRoute('index');       
        }

        return $this->render('ent_form.html.twig', [
            'formEnt' => $formEnt->createView(),
        ]);
    }

    /**
     * @Route("/infoentreprise/{id}", name="infoentreprise")
     */
    public function infoentreprise($id): Response
    {
        $entreprise = $this->getDoctrine()->getRepository('App:Entreprise')->find($id);
        

        return $this->render('ent_infos.html.twig', [
            'entreprise' => $entreprise,
        ]);
    }
}
