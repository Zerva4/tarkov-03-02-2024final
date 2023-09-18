<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Skill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use function Symfony\Component\Translation\t;

class SkillFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('translations', TranslationsType::class, [
                'locales' => ['ru', 'en'],
                'default_locale' => ['ru'],
                'required_locales' => ['ru'],
                'fields' => [
                    'name' => [
                        'field_type' => TextType::class,
                        'label' => t('Name', [], 'admin.places')
                    ]
                ],
                'excluded_fields' => ['createdAt', 'updatedAt'],
            ])
            ->add('level', IntegerType::class, [
                'label' => t('Level', [], 'admin.places')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Skill::class,
        ]);
    }
}
