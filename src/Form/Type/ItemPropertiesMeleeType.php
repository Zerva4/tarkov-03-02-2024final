<?php

namespace App\Form\Type;

use App\Entity\Item\ItemPropertiesMelee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemPropertiesMeleeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('slashDamage')
            ->add('stabDamage')
            ->add('hitRadius')
//            ->add('item')
//            ->add('material')
//            ->add('grids')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ItemPropertiesMelee::class,
        ]);
    }
}
