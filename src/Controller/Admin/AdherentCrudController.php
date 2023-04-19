<?php

namespace App\Controller\Admin;

use App\Entity\Adherent;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AdherentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Adherent::class;
    }

  
    public function configureFields(string $pageName): iterable
    {

        return [
            TextField::new('identifiant'),
            TextField::new('nom'),
            TextField::new('prenom'),
            EmailField::new('email'),
            TelephoneField::new('telephone'),
            AssociationField::new('site'),
            AssociationField::new('statut')->hideOnIndex(),
            AssociationField::new('service')->hideOnIndex(),
            AssociationField::new('fonction')->hideOnIndex(),
            DateField::new('date_inscription')->hideOnForm(),
        ];
    }
   
}
