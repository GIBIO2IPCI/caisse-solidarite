<?php

namespace App\Controller\Admin;

use App\Entity\Assistance;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
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
            IdField::new('id')->hideOnIndex()->hideOnForm(),
            AssociationField::new('adherent'),
            AssociationField::new('evenement'),
            DateTimeField::new('date_assistance')->hideOnForm(),
            
            
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add("evenement");
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::DETAIL,
             fn (Action $action) => $action->setIcon('fa fa-eye')->addCssClass('btn btn-info'))
            ->update(Crud::PAGE_INDEX, Action::EDIT,
                fn (Action $action) => $action->setIcon('fa fa-edit')->addCssClass('btn btn-warning'))
            ->update(Crud::PAGE_INDEX, Action::DELETE,
                fn (Action $action) => $action->setIcon('fa fa-trash')->addCssClass('btn btn-danger text-white'))
            ;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // ...
            ->showEntityActionsInlined()
            ;
    }
}
