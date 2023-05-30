<?php

namespace App\Controller\Admin;

use App\Entity\AutreDepense;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class AutreDepenseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AutreDepense::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->hideOnIndex(),
            AssociationField::new('adherent'),
            AssociationField::new('evenement'),
            IntegerField::new('montant'),
            DateField::new('date_depense', 'Date de la dépense')->hideOnForm(),
        ];
    }
}
