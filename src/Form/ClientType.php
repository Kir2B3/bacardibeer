<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Bar;
use App\Entity\Biere;
use App\Entity\Client;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('adresse', AdresseType::class)
            ->add('bars', EntityType::class, [
                'class' => Bar::class,
                'choice_label' => 'nom',
                'multiple' => true,
            ])
            ->add('bieres', EntityType::class, [
                'class' => Biere::class,
                'choice_label' => 'nom',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
