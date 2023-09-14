<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Item\ItemPropertiesMelee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use function Symfony\Component\Translation\t;

class ItemPropertiesMeleeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('slashDamage', IntegerType::class, [
                    'label' => t('Slash damage', [], 'admin.properties.items'),
                    'required' => true,
                    'empty_data' => 0,
                    'constraints' => [
                        new NotBlank()
                    ],
            ])
            ->add('stabDamage', IntegerType::class, [
                'label' => t('Stab damage', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('hitRadius', NumberType::class, [
                'label' => t('Hit radius', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
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
