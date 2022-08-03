<?php

namespace App\Form\Field;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;

final class TranslationsFormField implements FieldInterface
{
    use FieldTrait;

    /**
     * @param string $propertyName
     * @param string|null $label
     * @return static
     */
    public static function new(string $propertyName, ?string $label = null): self
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setFormTypeOptions([
                'compound' => true
            ])
            ->setFormType(TranslationsType::class)
            ->addCssClass('translations_form_field')
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'translations_form_field';
    }
}