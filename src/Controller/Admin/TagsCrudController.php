<?php

namespace App\Controller\Admin;

use App\Entity\Tags;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TagsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tags::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('tag'),
            
        ];
    }
    
}
