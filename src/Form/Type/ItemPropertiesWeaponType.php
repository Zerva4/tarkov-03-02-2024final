<?php

namespace App\Form\Type;

use App\Entity\Item\ItemPropertiesWeapon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use function Symfony\Component\Translation\t;

class ItemPropertiesWeaponType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('caliber', TextType::class, [
                'label' => t('Caliber', [], 'admin.properties.items'),
                'required' => true,
                'attr' => [
                    'maxlength' => 64,
                ],
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            // todo
//            ->add('defaultAmmo')
            ->add('effectiveDistance', IntegerType::class, [
                'label' => t('Effective distance', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('ergonomics', NumberType::class, [
                'label' => t('Ergonomics', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            // todo
//            ->add('fireModes')
            ->add('fireRate', IntegerType::class, [
                'label' => t('Fire rate', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('maxDurability', IntegerType::class, [
                'label' => t('Max. durability', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('recoilVertical', IntegerType::class, [
                'label' => t('Recoil vertical', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('recoilHorizontal', IntegerType::class, [
                'label' => t('Recoil horizontal', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('repairCost', IntegerType::class, [
                'label' => t('Repair cost', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('sightingRange', IntegerType::class, [
                'label' => t('Sighting range', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('centerOfImpact', NumberType::class, [
                'label' => t('Center of impact', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('deviationCurve', NumberType::class, [
                'label' => t('Deviation curve', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('recoilDispersion', IntegerType::class, [
                'label' => t('Recoil dispersion', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('recoilAngle', IntegerType::class, [
                'label' => t('Recoil angle', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('cameraRecoil', NumberType::class, [
                'label' => t('Camera recoil', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('cameraSnap', NumberType::class, [
                'label' => t('Camera snap', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('deviationMax', NumberType::class, [
                'label' => t('Deviation max.', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('convergence', NumberType::class, [
                'label' => t('Convergence', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('defaultWidth', IntegerType::class, [
                'label' => t('Default width', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('defaultHeight', IntegerType::class, [
                'label' => t('Default height', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('defaultErgonomics', NumberType::class, [
                'label' => t('Default ergonomics', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('defaultRecoilVertical', IntegerType::class, [
                'label' => t('Default recoil vertical', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('defaultRecoilHorizontal', IntegerType::class, [
                'label' => t('Default recoil horizontal', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('defaultWeight', NumberType::class, [
                'label' => t('Default weight', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            // todo
//            ->add('defaultPreset')
//            ->add('allowedPresets')
//            ->add('allowedAmmo')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ItemPropertiesWeapon::class,
        ]);
    }
}
