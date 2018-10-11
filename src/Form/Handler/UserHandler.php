<?php

namespace App\Form\Handler;

use App\Entity\User;
use App\Model\User as userModel;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\ORMException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserHandler
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var LoggerInterface
     */
    private $loggerInterface;

    public function __construct(ObjectManager $objectManager, LoggerInterface $loggerInterface)
    {
        $this->objectManager = $objectManager;
        $this->loggerInterface = $loggerInterface;
    }

    public function handle(FormInterface $form, Request $request, UserPasswordEncoderInterface $encoder)
    {
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /**
             * @var UserModel $userModel
             */
            $userModel = $form->getData();

            print_r($userModel->userstatut);

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

            return true;
        }

        return false;
    }
}