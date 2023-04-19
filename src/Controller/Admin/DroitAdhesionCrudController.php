<?php

namespace App\Controller\Admin;

use App\Entity\DroitAdhesion;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;

class DroitAdhesionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DroitAdhesion::class;
    }

    public function configureCrud(Crud $crud):Crud
    {
 
     return $crud
         ->showEntityActionsInlined();
    }

   
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            MoneyField::new('montant')->setCurrency('XOF'),
            DateTimeField::new('date_adhesion'),
        ];
    }

    public function configureActions(Actions $actions): Actions
   {
       return $actions
           ->update(Crud::PAGE_INDEX, Action::EDIT,
               fn (Action $action) => $action->setIcon('fa fa-edit')->addCssClass('btn btn-warning'))
               ->update(Crud::PAGE_INDEX, Action::DELETE,
               fn (Action $action) => $action->setIcon('fa fa-trash')->addCssClass('btn btn-danger text-white'))
           ;
   }
}
