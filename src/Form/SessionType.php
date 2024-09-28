<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Formateur;
use App\Entity\Module;
use App\Entity\Session;
use App\Entity\Stagiaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('nbrePlace')
            ->add('dateDebut', null, [
                'widget' => 'single_text',
            ])
            ->add('dateFin', null, [
                'widget' => 'single_text',
            ])
            ->add('stagiaires', EntityType::class, [
                'class' => Stagiaire::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('stagiaire', EntityType::class, [
                'class' => Stagiaire::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('formateur', EntityType::class, [
                'class' => Formateur::class,
                'choice_label' => 'id',
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'id',
            ])
            ->add('modules', EntityType::class, [
                'class' => Module::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
