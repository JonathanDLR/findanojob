<?php

namespace App\Form\Handler;

use App\Entity\Stagiaire;
use App\Entity\User;
use App\Model\Stagiaire as StagiaireModel;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;


class StagiaireHandler
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
             * @var StagiaireModel $stagiaireModel
             */
            $stagiaireModel = $form->getData();

            /**
             * @var Stagiaire $stagiaire
             */


            $user = $this->security->getUser();
            
            $stagiaire = new Stagiaire();

            
            $stagiaire->setNom($stagiaireModel->nom);
            $stagiaire->setPrenom($stagiaireModel->prenom);
            $stagiaire->setAdresse($stagiaireModel->adresse);
            $stagiaire->setVille($stagiaireModel->ville);
            $stagiaire->setDepartement($stagiaireModel->departement);
            $stagiaire->setRegion($stagiaireModel->region);
            $stagiaire->setDateDebut($stagiaireModel->date_debut);
            $stagiaire->setDateFin($stagiaireModel->date_fin);
            $stagiaire->setAge($stagiaireModel->age);
            $stagiaire->setSexe($stagiaireModel->sexe);
            $stagiaire->setPresentation($stagiaireModel->presentation);
            $stagiaire->setUser($user);
            
            try {
                $this->objectManager->persist($stagiaire);
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