<?php

namespace App\Controller;

use App\Form\Handler\UserHandler;
use App\Form\Type\RegisterType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use App\Entity\User;
use App\Model\User as userModel;
use Doctrine\Common\Persistence\ObjectManager;
use Psr\Log\LoggerInterface;

class SecurityController extends AbstractController
{
    public function __construct(ObjectManager $objectManager, LoggerInterface $loggerInterface)
    {
        $this->objectManager = $objectManager;
        $this->loggerInterface = $loggerInterface;
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register(UserHandler $formHandler, Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class);
        

        if($form->handleRequest($request)) {
            if($form->isSubmitted() && $form->isValid()) {
                /**
                 * @var UserModel $userModel
                 */
                $userModel = $form->getData();
    
                /**
                 * @var User $user
                 */
    
                $user = new User();
                $user->setUsername($userModel->username);
                $user->setMail($userModel->email);
    
                $passEncoded = $encoder->encodePassword($user, $userModel->password);
                $user->setPassword($passEncoded);
    
                
    
                try {
                    $this->objectManager->persist($user);
                }
                catch (ORMException $e) {
                   $this->loggerInterface->error($e->getMessage());
                   $form->addError(new FormError('Erreur lors de l\'insertion en base'));
                   return false;
                }
    
                $this->objectManager->flush();

                $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
                $this->get('security.token_storage')->setToken($token);
                $this->get('session')->set('_security_main', serialize($token));

                if($userModel->userstatut == 1) {
                    return $this->redirectToRoute('ent_form');
                }
                elseif($userModel->userstatut == 2) {
                    return $this->redirectToRoute('stagiaire');
                }
            }
            return $this->render('security/register.html.twig', ['form' => $form->createView()]);
        }
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