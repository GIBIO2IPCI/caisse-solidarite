<?php

namespace App\Controller\Admin;

use App\Entity\TypeDon;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TypeDonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeDon::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
