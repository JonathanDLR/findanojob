<?php

namespace App\Controller;

use App\Form\Handler\UserHandler;
use App\Form\Type\RegisterType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(UserHandler $formHandler, Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $form = $this->createForm(RegisterType::class);
        

        if($formHandler->handle($form, $request, $encoder)) {
            if($formHandler->userstatut == 1) {
                return $this->redirectToRoute('ent_form');
            }
            elseif($formHandler->userstatut == 2) {
                return $this->redirectToRoute('stag_form');
            }
        }

        return $this->render('security/register.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('security/login.html.twig', [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'last_username' => $authenticationUtils->getLastUsername()
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {

    }
}