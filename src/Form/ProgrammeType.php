<?php

namespace App\Form;

use App\Entity\Module;
use App\Entity\Programme;
use App\Entity\Session;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

class ProgrammeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('duree', IntegerType::class, [
                'label' => 'Durée',
                'constraints' => [
                    new GreaterThanOrEqual([
                        'value' => 0,
                        'message' => 'La durée doit être un nombre entier positif ou zéro.',
                    ]),
                ],
            ])
            ->add('session', EntityType::class, [
                'class' => Session::class,
                'choice_label' => 'nom',
            ])
            ->add('module', EntityType::class, [
                'class' => Module::class,
                'choice_label' => 'nom',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Programme::class,
        ]);
    }
}
