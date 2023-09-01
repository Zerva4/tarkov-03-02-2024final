<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Workshop\Place;
use App\Entity\Workshop\PlaceLevelRequired;
use App\Repository\Workshop\PlaceRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Symfony\Component\Translation\t;

class PlaceLevelRequiredType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('place', EntityType::class, [
                'label' => t('Place', [], 'admin.places'),
                'class' => Place::class,
                'placeholder' => t('Select item', [], 'admin'),
                'query_builder' => function (PlaceRepository $er) {
                    return $er->createQueryBuilder('place')
                        ->join('place.translations', 'lt', 'WITH', 'place.id = lt.translatable')
                        ->addSelect('lt')
                        ->andWhere('lt.locale = :locale')
                        ->setParameter('locale', 'ru')
                        ->orderBy('lt.name', 'ASC');
                },
                'expanded'=> false,
                'by_reference' => true,
                'required' => true
            ])
            ->add('level', IntegerType::class, [
                'label' => t('Level', [], 'admin.places')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlaceLevelRequired::class,
        ]);
    }
}
