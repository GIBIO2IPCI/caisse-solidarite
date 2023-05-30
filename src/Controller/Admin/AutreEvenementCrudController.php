<?php

namespace App\Controller\Admin;

use App\Entity\AutreEvenement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AutreEvenementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AutreEvenement::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->hideOnIndex(),
            TextField::new('libelle', 'Libellé'),
            AssociationField::new('type'),
        ];
    }
}
