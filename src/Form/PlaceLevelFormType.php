<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Workshop\PlaceLevel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Symfony\Component\Translation\t;

class PlaceLevelFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('levelOrder', IntegerType::class, [
                'label' => t('Order level', [], 'admin.places')
            ])
            ->add('level', IntegerType::class, [
                'label' => t('Level', [], 'admin.places')
            ])
            ->add('constructionTime', IntegerType::class, [
                'label' => t('Construction time (sec.)', [], 'admin.places')
            ])
            ->add('requiredItems', CollectionType::class, [
                'attr' => ['data-ea-widget' => 'ea-autocomplete'],
                'label' => t('Required items', [], 'admin.places'),
                'entry_type' => ContainedItemForm::class,
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true
            ])
            ->add('requiredPlacesLevels', CollectionType::class, [
                'label' => t('Required places Level', [], 'admin.places'),
                'entry_type' => PlaceLevelRequiredType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true
            ])
            ->add('requiredSkills', CollectionType::class, [
                'label' => t('Required skills', [], 'admin.places'),
                'entry_type' => SkillFormType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true
            ])
            ->add('requiredTraders', CollectionType::class, [
                'attr' => ['data-ea-widget' => 'ea-autocomplete'],
                'label' => t('Required traders', [], 'admin.places'),
                'entry_type' => TraderRequiredType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlaceLevel::class,
        ]);
    }
}
