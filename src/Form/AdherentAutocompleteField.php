<?php

namespace App\Form;

use App\Entity\Adherent;
use App\Repository\AdherentRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\ParentEntityAutocompleteType;

#[AsEntityAutocompleteField]
class AdherentAutocompleteField extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Adherent::class,
            'placeholder' => 'Choose a Adherent',
            // 'choice_label' => 'name',

            'query_builder' => function (AdherentRepository $adherentRepository) {
                return $adherentRepository->createQueryBuilder('adherent');
            },
            // 'security' => 'ROLE_SOMETHING',
        ]);
    }

    public function getParent(): string
    {
        return ParentEntityAutocompleteType::class;
    }
}
