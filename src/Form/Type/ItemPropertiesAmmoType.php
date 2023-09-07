<?php

namespace App\Form\Type;

use App\Entity\Item\ItemPropertiesAmmo;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use function Symfony\Component\Translation\t;

class ItemPropertiesAmmoType extends AbstractType
{
    public ContainerInterface $container;

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
//            ->add('ammo-group', FormType::class, ['inherit_data' => true])
//            ->get('ammo-group')
            ->add('caliber', TextType::class, [
                'label' => t('Caliber', [], 'admin.properties.items'),
                'required' => true,
//                'row_attr' => [
//                    'class' => 'col-md-3'
//                ],
                'attr' => [
                    'maxlength' => 64,
                ],
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('stackMaxSize', IntegerType::class, [
                'label' => t('stackMaxSize', [], 'admin.properties.items'),
//                'row_attr' => [
//                    'class' => 'col-md-3'
//                ],
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('tracer', CheckboxType::class, [
                'label' => t('Tracer', [], 'admin.properties.items'),
                'required' => false,
                'empty_data' => false,
            ])
            ->add('tracerColor', TextType::class, [
                'label' => t('Tracer color', [], 'admin.properties.items'),
                'required' => false,
                'empty_data' => '',
                'attr' => [
                    'maxlength' => 64
                ],
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('ammoType', TextType::class, [
                'label' => t('Ammo type', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => '',
                'attr' => [
                    'maxlength' => 64
                ],
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('projectileCount', IntegerType::class, [
                'label' => t('Projectile count', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('damage', IntegerType::class, [
                'label' => t('Damage', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('armorDamage', IntegerType::class, [
                'label' => t('Armor damage', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('fragmentationChance', NumberType::class, [
                'label' => t('Fragmentation chance', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('ricochetChance', NumberType::class, [
                'label' => t('Ricochet chance', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('penetrationChance', NumberType::class, [
                'label' => t('Penetration chance', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('penetrationPower', IntegerType::class, [
                'label' => t('Penetration power', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('accuracyModifier', NumberType::class, [
                'label' => t('Accuracy modifier', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('recoilModifier', NumberType::class, [
                'label' => t('Recoil modifier', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('initialSpeed', NumberType::class, [
                'label' => t('Initial speed', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('lightBleedModifier', NumberType::class, [
                'label' => t('Light bleed modifier', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('heavyBleedModifier', NumberType::class, [
                'label' => t('Heavy bleed modifier', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('durabilityBurnFactor', NumberType::class, [
                'label' => t('Durability burn factor', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('heatFactor', NumberType::class, [
                'label' => t('Heat factor', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('staminaBurnPerDamage', NumberType::class, [
                'label' => t('Stamina burn per damage', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('ballisticCoefficient', NumberType::class, [
                'label' => t('Ballistic coefficient', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('bulletDiameterMillimeters', NumberType::class, [
                'label' => t('Bullet diameter millimeters', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('bulletMassGrams', NumberType::class, [
                'label' => t('Bullet mass grams', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ItemPropertiesAmmo::class,
            'cascade_validation' => true,
            'render_fieldset' => false,
            'show_legend' => false,
        ]);
    }

    public function setDefaultOptions(OptionsResolver $resolver): void
    {
        $this->configureOptions($resolver);
    }

    public function getName(): string
    {
        return 'Item_properties_ammo';
    }

    public function onPreSetData(FormEvent $event): void
    {
        dump($event);
    }
}
