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


class MajStagiaireHandler
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
            $stagiaireModel = $form->getData();
            $user = $this->security->getUser();
            $id = $user->getId();
            $stagiaire = $this->em->getRepository('App:Stagiaire')->findOneBy([
                'user' => $id
                ]);

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

            $this->objectManager->flush();
        }
    }
}

?>