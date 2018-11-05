<?php

namespace App\Form\Handler;

use App\Entity\Entreprise;
use App\Entity\User;
use App\Model\Entreprise as EntrepriseModel;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;


class EntrepriseHandler
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var Security
     */
    private $security;

    public function __construct(ObjectManager $objectManager, EntityManagerInterface $em, Security $security)
    {
        $this->objectManager = $objectManager;
        $this->em = $em;
        $this->security = $security;
    }

    public function handle(FormInterface $form, Request $request)
    {
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /**
             * @var EntrepriseModel $entrepriseModel
             */
            $entrepriseModel = $form->getData();

            /**
             * @var Entreprise $entreprise
             */


            $user = $this->security->getUser();
            
            $entreprise = new Entreprise();

            
            $entreprise->setNom($entrepriseModel->nom);
            $entreprise->setSiret($entrepriseModel->siret);
            $entreprise->setAdresse($entrepriseModel->adresse);
            $entreprise->setVille($entrepriseModel->ville);
            $entreprise->setDepartement($entrepriseModel->departement);
            $entreprise->setRegion($entrepriseModel->region);
            $entreprise->setPresentation($entrepriseModel->presentation);
            $entreprise->setUser($user);
            
            try {
                $this->objectManager->persist($entreprise);
            }
            catch (ORMException $e) {
               $this->loggerInterface->error($e->getMessage());
               $form->addError(new FormError('Erreur lors de l\'insertion en base'));
               return false;
            }

            $this->objectManager->flush();

            $user->setFinish(true);
            $this->objectManager->persist($user);
            $this->objectManager->flush();

            return true;
        }

        return false;
    }
}