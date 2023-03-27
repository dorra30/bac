<?php

namespace App\Form;

use App\Entity\DateEp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateEpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('lycee')
            ->add('center')
            ->add('enseigant1')
            ->add('enseigant2')
            ->add('enseigant3')
            ->add('jury')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DateEp::class,
        ]);
    }
}
