<?php

namespace App\Controller\Admin;

use App\Entity\Fonction;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FonctionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Fonction::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('libelle'),
            
        ];
    }

   public function configureCrud(Crud $crud):Crud
   {

    return $crud
        ->showEntityActionsInlined()
         ->setPageTitle('new', 'Enregistrement')
         ->setPageTitle('index', 'Liste des fonctions');
   }

   public function configureActions(Actions $actions): Actions
   {
       return $actions
           ->update(Crud::PAGE_INDEX, Action::EDIT,
               fn (Action $action) => $action->setIcon('fa fa-edit')->addCssClass('btn btn-warning'))
           ->update(Crud::PAGE_INDEX, Action::DELETE,
               fn (Action $action) => $action->setIcon('fa fa-trash')->addCssClass('btn btn-danger text-white'))
                 ->update(Crud::PAGE_INDEX, Action::NEW,
                fn (Action $action) => $action->setLabel("Ajouter une fonction")
            )
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN,
                fn (Action $action) => $action->setLabel("Enregistrer")
            )
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER,
                fn (Action $action) => $action->setLabel("Enregistrer et ajouter une autre fonction")
            )
           ;
   }


}
