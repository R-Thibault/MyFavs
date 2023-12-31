<?php

namespace App\Form;

use App\Entity\Tags;
use App\Entity\Users;
use App\Entity\FavCardsPrivate;
use App\Entity\FavCardsPublic;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CardRequestFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('link')
            ->add('Author', EntityType::class, [
                'class' => Users::class,
                'choice_label' => 'nickname',
                'multiple' => false,
                'help' => 'This field is automatically filled in.',
                'by_reference' => false,
                
                'attr' => array ('readonly' => true)
               
            ]
            )
            
    ->add('status', IntegerType::class,[
        'attr' => array ('readonly' => true)
    
    ]) 
    ->add('Tag', CollectionType::class, [
        'entry_type' => Tags::class,
        'entry_options' => ['label' => false],
        'allow_add' => true,
        'allow_delete' => true,
        'by_reference' => false,
    ]);

    //     ->add('Tag'
    //     , EntityType::class, [
    //         'class' => Tags::class,
    //         'choice_label' => 'tag',
    //         'multiple' => true,
    //         'query_builder' => function (EntityRepository $er) {
    //             return $er->createQueryBuilder('u')
    //                 ->orderBy('u.tag', 'ASC');
    //         },
    //         // 'by_reference' => false,
    //     ]
    // );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FavCardsPublic::class, FavCardsPrivate::class,
        ]);
    }
}
