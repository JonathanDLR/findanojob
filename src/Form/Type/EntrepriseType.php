<?php

namespace App\Form\Type;

use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('siret')
            ->add('adresse')
            ->add('ville')
            ->add('departement')
            ->add('region')
            ->add('presentation')
            ->add('submit', SubmitType::class, [
                'label' => 'Validez vos informations',
                'attr' => ['class' => 'btn btn-primary btn-lg']]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}
