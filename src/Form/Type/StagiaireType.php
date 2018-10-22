<?php

namespace App\Form\Type;

use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StagiaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('ville')
            ->add('departement')
            ->add('region')
            ->add('date_debut')
            ->add('date_fin')
            ->add('age')
            ->add('sexe')
            ->add('presentation')
            ->add('submit', SubmitType::class, [
                'label' => 'Validez vos informations',
                'attr' => ['class' => 'btn btn-primary btn-lg']]
            );
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stagiaire::class,
        ]);
    }
}
