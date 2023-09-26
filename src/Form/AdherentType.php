<?php

namespace App\Form;

use App\Entity\Adherent;
use App\Entity\Sexe;
use App\Entity\SiteAdherent;
use App\Entity\StatutAdherent;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdherentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,)
            ->add('prenom', TextType::class)
            ->add('email', TextType::class)
            ->add('telephone', TextType::class)
            ->add('date_inscription', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('birthday', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('statut', EntityType::class, [
                'class' => StatutAdherent::class,
            ])
            ->add('site', EntityType::class, [
                'class' => SiteAdherent::class,
                'choice_label' => 'libelle',
            ])
            ->add('service', EntityType::class, [
                'class' => SiteAdherent::class,
                'choice_label' => 'libelle',
            ])
            ->add('fonction', EntityType::class, [
                'class' => SiteAdherent::class,
                'choice_label' => 'libelle',
            ])
            ->add('sexe', EntityType::class, [
                'class' => Sexe::class,
                'choice_label' => 'libelle',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adherent::class,
        ]);
    }
}
