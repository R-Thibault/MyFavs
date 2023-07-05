<?php

namespace App\Form;

use App\Entity\FavCardsPrivate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CardPrivateFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('link')
            ->add('status')
            ->add('created_at')
            ->add('updated_at')
            ->add('Tag')
            //->add('Author')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FavCardsPrivate::class,
        ]);
    }
}
