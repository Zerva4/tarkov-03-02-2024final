<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Item\ItemPropertiesBackpack;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use function Symfony\Component\Translation\t;

class ItemPropertiesBackpackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('capacity', IntegerType::class, [
                'label' => t('Capacity', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('speedPenalty', NumberType::class, [
                'label' => t('Speed penalty', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('turnPenalty', NumberType::class, [
                'label' => t('Turn penalty', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('ergoPenalty', IntegerType::class, [
                'label' => t('Ergo penalty', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ItemPropertiesBackpack::class,
        ]);
    }
}
