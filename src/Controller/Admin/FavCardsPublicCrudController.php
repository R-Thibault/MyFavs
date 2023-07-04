<?php

namespace App\Controller\Admin;

use App\Entity\FavCardsPublic;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class FavCardsPublicCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FavCardsPublic::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('title'),
            TextEditorField::new('description'),
            TextField::new('link'),
            IntegerField::new('status'),
            AssociationField::new('Tag')->setRequired(true)
        ];
    }
    
}
