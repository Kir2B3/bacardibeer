<?php

namespace App\Form;

use App\Entity\Bar;
use App\Entity\Biere;
use App\Entity\Tarif;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TarifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prix')
            ->add('biere', EntityType::class, [
                'class' => Biere::class,
                'choice_label' => 'getFullNom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tarif::class,
        ]);
    }
}
