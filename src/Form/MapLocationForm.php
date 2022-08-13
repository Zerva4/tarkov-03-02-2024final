<?php

declare(strict_types=1);

namespace App\Form;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use App\Entity\MapLocation;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Symfony\Component\Translation\t;

class MapLocationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $fields = [
            'name' => [
                'field_type' => TextType::class,
                'label' => t('Name', [], 'admin.maps'),
                'attr' => [
                    'class' => 'field-boolean'
                ]
            ],
            'description' => [
                'field_type' => CKEditorType::class,
                'label' => t('Description', [], 'admin.maps'),
                'attr' => [
                    'class' => 'ckeditor'
                ]
            ]
        ];
        $builder
            ->add('translations', TranslationsType::class, [
                'fields' => $fields,
                'label' => ' ',
                'excluded_fields' => ['lang', 'createdAt', 'updatedAt']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MapLocation::class,
        ]);
    }
}
