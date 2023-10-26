<?php

namespace App\Form;

use App\Entity\Trader\Trader;
use App\Entity\Trader\TraderStanding;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Symfony\Component\Translation\t;

class TraderStandingForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('trader', EntityType::class, [
                'class' => Trader::class,
                'label' => t('Trader', [], 'admin.traders'),
                'placeholder' => t('Select item', [], 'admin'),
                'attr' => ['data-ea-widget' => 'ea-autocomplete'],
                'expanded'=> false,
                'by_reference' => true,
                'required' => true
            ])
            ->add('standing', NumberType::class, [
                'label' => t('Standing', [], 'admin.traders'),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TraderStanding::class,
        ]);
    }
}
