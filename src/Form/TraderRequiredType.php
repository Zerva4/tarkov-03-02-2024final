<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Trader\Trader;
use App\Entity\Trader\TraderRequired;
use App\Repository\Trader\TraderRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Symfony\Component\Translation\t;

class TraderRequiredType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('trader', EntityType::class, [
                'label' => t('Trader', [], 'admin.places'),
                'class' => Trader::class,
                'placeholder' => t('Select item', [], 'admin'),
                'query_builder' => function (TraderRepository $er) {
                    return $er->createQueryBuilder('trader')
                        ->join('trader.translations', 'lt', 'WITH', 'trader.id = lt.translatable')
                        ->addSelect('lt')
                        ->andWhere('lt.locale = :locale')
                        ->setParameter('locale', 'ru')
                        ->orderBy('lt.shortName', 'ASC');
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
            'data_class' => TraderRequired::class,
        ]);
    }
}
