<?php

namespace App\Controller\Admin;

use App\Entity\StatutAdherent;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class StatutAdherentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StatutAdherent::class;
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
