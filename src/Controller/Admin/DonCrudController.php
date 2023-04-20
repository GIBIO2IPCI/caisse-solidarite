<?php

namespace App\Controller\Admin;

use App\Entity\Don;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Don::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->hideOnIndex(),
            TextareaField::new('libelle'),
            NumberField::new('montant_don'),
            DateTimeField::new('date_don')->hideOnForm(),
            AssociationField::new('type_don'),
            AssociationField::new('donnateur'),

        ];
    }

}
