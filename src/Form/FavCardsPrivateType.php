<?php

namespace App\Form;

use App\Entity\Tags;
use App\Entity\Users;
use App\Form\TagFormType;
use App\Entity\FavCardsPrivate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\LiveComponent\Form\Type\LiveCollectionType;

class FavCardsPrivateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        

        $builder
            ->add('title')
            ->add('description')
            ->add('link')
            ->add('Author' )
            
            ->add('Tag'
            , LiveCollectionType::class, [
                'entry_type' => TagFormType::class,
                'entry_options' => ['label' => false],
                'label' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ]
        );
            
        // ->add('Tag', EntityType::class, [
        //     'class' => Tags::class,
        //     'choice_label' => 'tag',
        //     'multiple' => true,
        //     'query_builder' => function (EntityRepository $er) {
        //         return $er->createQueryBuilder('u')
        //             ->orderBy('u.tag', 'ASC');
        //     },
        //     'by_reference' => false,
        // ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FavCardsPrivate::class,
        ]);
    }
}
