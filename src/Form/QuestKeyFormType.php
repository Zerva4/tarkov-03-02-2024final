<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Item\Item;
use App\Entity\Map;
use App\Entity\Quest\QuestKey;
use App\Repository\Item\ItemRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Symfony\Component\Translation\t;

class QuestKeyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('item', EntityType::class, [
                'label' => t('Key', [], 'admin.quests'),
                'class' => Item::class,
                'attr' => ['data-ea-widget' => 'ea-autocomplete'],
                'placeholder' => t('Select item', [], 'admin'),
                'query_builder' => function (ItemRepository $er) {
                    return $er->createQueryBuilder('item')
                        ->join('item.translations', 'lt', 'WITH', 'item.id = lt.translatable')
                        ->addSelect('lt')
                        ->andWhere('item.typeItem = :type')
                        ->andWhere('lt.locale = :locale')
                        ->setParameter('locale', 'ru')
                        ->setParameter('type', 'ItemPropertiesKey')
                        ->orderBy('lt.name', 'ASC');
                },
                'expanded'=> false,
                'by_reference' => true,
                'required' => true
            ])
            ->add('map', EntityType::class, [
                'label' => t('Map', [], 'admin.quests'),
                'class' => Map::class,
                'attr' => ['data-ea-widget' => 'ea-autocomplete'],
                'placeholder' => t('Select item', [], 'admin'),
//                'query_builder' => function (PlaceRepository $er) {
//                    return $er->createQueryBuilder('place')
//                        ->join('place.translations', 'lt', 'WITH', 'place.id = lt.translatable')
//                        ->addSelect('lt')
//                        ->andWhere('lt.locale = :locale')
//                        ->setParameter('locale', 'ru')
//                        ->orderBy('lt.title', 'ASC');
//                },
                'expanded'=> false,
                'by_reference' => true,
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => QuestKey::class,
        ]);
    }
}
