<?php

namespace App\Form\Type;

use App\Entity\Item\ItemMaterial;
use App\Entity\Item\ItemPropertiesGlasses;
use App\Repository\Item\ItemMaterialRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use function Symfony\Component\Translation\t;

class ItemPropertiesGlassesType extends AbstractType
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
            ->add('blindnessProtection', NumberType::class, [
                'label' => t('Blindness protection', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('material', EntityType::class, [
                'label' => t('Material', [], 'admin.properties.item'),
                'class' => ItemMaterial::class,
                'placeholder' => t('Select item', [], 'admin'),
                'attr' => array('class' => 'select2','data-widget' => 'select2'),
                // todo: check import material
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
            'data_class' => ItemPropertiesGlasses::class,
        ]);
    }
}
