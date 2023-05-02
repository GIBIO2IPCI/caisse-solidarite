<?php

namespace App\Controller\Admin;

use App\Entity\TypeAssistance;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TypeAssistanceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeAssistance::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('libelle'),
        ];
    }
}
