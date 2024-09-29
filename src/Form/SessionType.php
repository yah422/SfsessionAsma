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
            ->add('formateur', EntityType::class, [
                'class' => Formateur::class,
                'choice_label' => function (Formateur $formateur) {
                    return $formateur->getNom();
                },
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => function (Categorie $categorie) {
                    return $categorie->getNom();
                },
            ])
            ->add('modules', EntityType::class, [
                'class' => Module::class,
                'choice_label' => 'nom', // Assurez-vous que 'nom' est un champ valide
                'multiple' => true, // Pour permettre la sélection de plusieurs modules
                'expanded' => false, // false pour une liste déroulante
            ])
            ->add('stagiaires', EntityType::class, [
                'class' => Stagiaire::class,
                'choice_label' => 'nom', // Assurez-vous que 'nom' est un champ valide
                'multiple' => true, // Pour permettre la sélection de plusieurs stagiaires
                'expanded' => false, // false pour une liste déroulante
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}

