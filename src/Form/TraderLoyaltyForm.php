<?php

namespace App\Form;

use App\Entity\TraderLoyalty;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Symfony\Component\Translation\t;

class TraderLoyaltyForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('level', IntegerType::class, [
                'label' => t('Level', [], 'admin.traders')
            ])
            ->add('requiredLevel', IntegerType::class, [
                'label' => t('Required level', [], 'admin.traders')
            ])
            ->add('requiredReputation', NumberType::class, [
                'label' => t('Required reputation', [], 'admin.traders')
            ])
            ->add('requiredSales', IntegerType::class, [
                'label' => t('Required sales', [], 'admin.traders')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TraderLoyalty::class,
        ]);
    }
}
