<?php

declare(strict_types=1);

namespace App\Form;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use App\Entity\Quest\QuestObjective;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Symfony\Component\Translation\t;

class QuestObjectiveForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $fields = [
            'description' => [
                'field_type' => TextType::class,
                'label' => t('Description', [], 'admin.quests'),
                'attr' => ['data-ea-widget' => 'ea-autocomplete'],
            ]
        ];
        $builder
            ->add('type', ChoiceType::class, [
                'label' => t('Type', [], 'admin.quests'),
                'choices' => QuestObjective::$objectiveTypes,
                'choice_translation_domain' => 'admin.quests'
            ])
            ->add('optional', CheckboxType::class, [
                'label' => t('Optional', [], 'admin.quests')
            ])
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
            'data_class' => QuestObjective::class,
        ]);
    }
}
