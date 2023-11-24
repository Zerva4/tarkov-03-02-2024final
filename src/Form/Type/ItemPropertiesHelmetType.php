<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Item\ItemMaterial;
use App\Entity\Item\Properties\ItemPropertiesHelmet;
use App\Repository\Item\ItemMaterialRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use function Symfony\Component\Translation\t;

class ItemPropertiesHelmetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('class', IntegerType::class, [
                'label' => t('Class', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('durability', IntegerType::class, [
                'label' => t('Durability', [], 'admin.properties.items'),
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
//            ->add('headZones')
            ->add('material', EntityType::class, [
                'label' => t('Material', [], 'admin.properties.item'),
                'class' => ItemMaterial::class,
                'placeholder' => t('Select item', [], 'admin'),
                'attr' => array('class' => 'select2','data-widget' => 'select2'),
                'query_builder' => function (ItemMaterialRepository $er) {
                    return $er->createQueryBuilder('material')
                        ->join('material.translations', 'mt', 'WITH', 'material.id = mt.translatable')
                        ->addSelect('mt')
                        ->andWhere('mt.locale = :locale')
                        ->setParameter('locale', 'ru')
                        ->orderBy('mt.name', 'ASC');
                },
                'expanded'=> false,
                'by_reference' => true,
                'required' => false
            ])
            ->add('deafening', TextType::class, [
                'label' => t('Deafening', [], 'admin.properties.items'),
                'required' => false,
                'empty_data' => '',
                'attr' => [
                    'maxlength' => 64
                ],
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('blockHeadset', CheckboxType::class, [
                'label' => t('Block headset', [], 'admin.properties.items'),
                'required' => false,
                'empty_data' => false,
            ])
            ->add('blindnessProtection', NumberType::class, [
                'label' => t('Blindness protection', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('ricochetX', NumberType::class, [
                'label' => t('Ricochet X', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('ricochetY', NumberType::class, [
                'label' => t('Ricochet Y', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('ricochetZ', NumberType::class, [
                'label' => t('Ricochet Z', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('armorType', TextType::class, [
                'label' => t('Type', [], 'admin.properties.items'),
                'required' => false,
                'empty_data' => '',
                'attr' => [
                    'maxlength' => 64
                ],
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('bluntThroughput', NumberType::class, [
                'label' => t('Blunt throughput', [], 'admin.properties.items'),
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
            'data_class' => ItemPropertiesHelmet::class,
        ]);
    }
}
