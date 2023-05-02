<?php

namespace App\Controller\Admin;

use App\Entity\Assistance;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class AssistanceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Assistance::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateTimeField::new('date_assistance')->hideOnForm(),
            AssociationField::new('evenement'),
            AssociationField::new('adherent'),
        ];
    }
}
