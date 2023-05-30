<?php

namespace App\Controller\Admin;

use App\Entity\Don;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

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
            AssociationField::new('donnateur'),
            TextareaField::new('libelle'),
            AssociationField::new('type_don'),
            NumberField::new('montant_don')->hideOnIndex(),
            DateTimeField::new('date_don')->hideOnForm(),
            
            

        ];
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

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
        ->add('donnateur')
        ->add('type_don')
        ;
    }

}
