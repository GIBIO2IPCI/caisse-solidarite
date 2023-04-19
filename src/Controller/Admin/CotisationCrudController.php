<?php

namespace App\Controller\Admin;

use App\Entity\Cotisation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CotisationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cotisation::class;
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
