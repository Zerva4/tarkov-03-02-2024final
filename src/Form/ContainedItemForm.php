<?php

namespace App\Form;

use App\Entity\Items\ContainedItem;
use App\Entity\Items\Item;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Symfony\Component\Translation\t;

class ContainedItemForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('item', EntityType::class, [
                'label' => t('Item', [], 'admin.contained.item'),
                'class' => Item::class,
                'placeholder' => t('Select item', [], 'admin'),
                'required' => true
            ])
            ->add('count', NumberType::class, [
                'label' => t('Count', [], 'admin.contained.item')
            ])
            ->add('quantity', NumberType::class, [
                'label' => t('Quantity', [], 'admin.contained.item')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContainedItem::class,
        ]);
    }
}