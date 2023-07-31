<?php

namespace App\Controller\Admin;

use App\Entity\Adherent;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\DateTimeFilter;

class AdherentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Adherent::class;
    }

  
    public function configureFields(string $pageName): iterable
    {

        return [
            TextField::new('identifiant')->hideOnForm()->setColumns(6),
            TextField::new('nom')->setColumns(4),
            TextField::new('prenom')->setColumns(4),
            AssociationField::new('sexe')->setColumns(4),
            DateField::new('birthday', 'date de naissance')->hideOnIndex()->setColumns(4),
            EmailField::new('email')->hideOnIndex()->setColumns(4),
            TelephoneField::new('telephone')->setColumns(4),
            AssociationField::new('site')->setColumns(4),
            AssociationField::new('statut')->hideOnIndex()->setColumns(4),
            AssociationField::new('service')->setColumns(6),
            AssociationField::new('fonction')->hideOnIndex()->setColumns(6),
            DateField::new('date_inscription')->setColumns(6),
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
            ->update(Crud::PAGE_INDEX, Action::NEW,
                fn (Action $action) => $action->setLabel("Ajouter un adhérent")
            )
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN,
                fn (Action $action) => $action->setLabel("Enregistrer")
            )
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER,
                fn (Action $action) => $action->setLabel("Enregistrer et ajouter un autre adhérent")
            )
            ;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // ...
            ->showEntityActionsInlined()
            ->setPageTitle('new', 'Enregistrement')
            ->setPageTitle('index', 'Liste des adhérents')

            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(DateTimeFilter::new('date_inscription'))
            ->add('statut')
            ->add('identifiant')
            ->add('telephone')
            
            ;
    }

}
