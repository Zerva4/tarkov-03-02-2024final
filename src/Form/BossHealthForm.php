<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\BossHealth;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Symfony\Component\Translation\t;

class BossHealthForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('published', CheckboxType::class, [
                'label' => t('Published', [], 'admin.health')
            ])
            ->add('name', TextType::class, [
                'label' => t('Name', [], 'admin.health')
            ])
            ->add('max', IntegerType::class, [
                'label' => t('Max.', [], 'admin.health')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BossHealth::class,
        ]);
    }
}
