<?php

namespace App\Controller\Admin;

use App\Entity\Cotisation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CotisationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cotisation::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->hideOnIndex(),
            MoneyField::new('montant_cotisation')->setCurrency('XOF'),
            AssociationField::new('adherent'),
        ];
    }
    
}
