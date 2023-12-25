<?php

namespace App\Form\Type;

use App\Entity\Item\Item;
use App\Entity\Item\Properties\ItemPropertiesPreset;
use App\Repository\Item\ItemRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use function Symfony\Component\Translation\t;

class ItemPropertiesPresetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('baseItem', EntityType::class, [
                'label' => t('Base item', [], 'admin.properties.items'),
                'class' => Item::class,
                'placeholder' => t('Select item', [], 'admin'),
                'attr' => ['data-ea-widget' => 'ea-autocomplete'],
                'query_builder' => function (ItemRepository $er) {
                    return $er->createQueryBuilder('item')
                        ->join('item.translations', 'mt', 'WITH', 'item.id = mt.translatable')
                        ->addSelect('mt')
                        ->andWhere('mt.locale = :locale')
                        ->setParameter('locale', 'ru')
                        ->orderBy('mt.name', 'ASC');
                },
                'expanded'=> false,
                'by_reference' => true,
                'required' => false
            ])
            ->add('ergonomics', NumberType::class, [
                'label' => t('Ergonomics', [], 'admin.properties.items'),
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
            ->add('moa', IntegerType::class, [
                'label' => t('MOA', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('isDefault', CheckboxType::class, [
                'label' => t('Is default', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => false,
                'constraints' => [
                    new NotBlank()
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ItemPropertiesPreset::class,
        ]);
    }
}
