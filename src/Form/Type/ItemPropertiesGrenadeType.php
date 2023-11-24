<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Item\Properties\ItemPropertiesGrenade;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use function Symfony\Component\Translation\t;

class ItemPropertiesGrenadeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', TextType::class, [
                'label' => t('Type', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => '',
                'attr' => [
                    'maxlength' => 64
                ],
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('fuse', NumberType::class, [
                'label' => t('Fuse', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('minExplosionDistance', IntegerType::class, [
                'label' => t('Min. explosion distance', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('maxExplosionDistance', IntegerType::class, [
                'label' => t('Max. explosion distance', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('fragments', IntegerType::class, [
                'label' => t('Fragments', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('contusionRadius', IntegerType::class, [
                'label' => t('Contusion radius', [], 'admin.properties.items'),
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
            'data_class' => ItemPropertiesGrenade::class,
        ]);
    }
}
