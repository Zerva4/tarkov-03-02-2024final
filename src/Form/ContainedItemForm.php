<?php

namespace App\Form;

use App\Entity\Item\ContainedItem;
use App\Entity\Item\Item;
use App\Repository\Item\ItemRepository;
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
                'attr' => array('class' => 'select2','data-widget' => 'select2'),
                'query_builder' => function (ItemRepository $er) {
                    return $er->createQueryBuilder('item')
                        ->join('item.translations', 'lt', 'WITH', 'item.id = lt.translatable')
                        ->addSelect('lt')
                        ->andWhere('lt.locale = :locale')
                        ->setParameter('locale', 'ru')
                        ->orderBy('lt.title', 'ASC');
                },
                'expanded'=> false,
                'by_reference' => true,
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