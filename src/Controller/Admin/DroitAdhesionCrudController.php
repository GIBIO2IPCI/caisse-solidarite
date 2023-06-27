<?php

namespace App\Controller\Admin;

use App\Entity\DroitAdhesion;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class DroitAdhesionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DroitAdhesion::class;
    }

    public function configureCrud(Crud $crud):Crud
    {
 
     return $crud
         ->showEntityActionsInlined()
         ->setPageTitle('new', 'Enregistrement')
         ->setPageTitle('index', 'Liste des adhésions')
         ;
    }

   
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex()->hideOnForm(),
            NumberField::new('montant')->onlyOnDetail(),
            AssociationField::new('adherent'),
            DateTimeField::new('date_adhesion')->hideOnForm(),
            
        ];
    }

    public function configureActions(Actions $actions): Actions
   {
       return $actions
           ->update(Crud::PAGE_INDEX, Action::EDIT,
               fn (Action $action) => $action->setIcon('fa fa-edit')->addCssClass('btn btn-warning'))
               ->update(Crud::PAGE_INDEX, Action::DELETE,
               fn (Action $action) => $action->setIcon('fa fa-trash')->addCssClass('btn btn-danger text-white'))
               ->update(Crud::PAGE_INDEX, Action::NEW,
                fn (Action $action) => $action->setLabel("Ajouter une adhésion")
            )
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN,
                fn (Action $action) => $action->setLabel("Enregistrer")
            )
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER,
                fn (Action $action) => $action->setLabel("Enregistrer et ajouter une autre adhésion")
            )
           ;
   }

   public function configureFilters(Filters $filters): Filters
   {
        return $filters
        ->add('adherent');
   }
}
