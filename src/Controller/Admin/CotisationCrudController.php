<?php

namespace App\Controller\Admin;

use App\Entity\Cotisation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CotisationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cotisation::class;
    }

    public function configureCrud(Crud $crud):Crud
   {

    return $crud
        ->showEntityActionsInlined();
   }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex()->hideOnForm(),
            AssociationField::new('adherent'),
            NumberField::new('montant_cotisation')->hideOnForm(),
            DateField::new('date_cotisation')->setFormat('MM-yyyy')->renderAsChoice(),
            
        ];
    }

    public function configureActions(Actions $actions): Actions
   {
       return $actions
           ->update(Crud::PAGE_INDEX, Action::EDIT,
               fn (Action $action) => $action->setIcon('fa fa-edit')->addCssClass('btn btn-warning'))
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
           ;
   }
    
   public function configureFilters(Filters $filters): Filters
   {
        return $filters
        ->add('adherent')
        
        ;
   }

}
