<?php

declare(strict_types=1);

namespace App\Form\Field;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use Symfony\Component\Translation\TranslatableMessage;
use Symfony\Component\Validator\Constraints as Assert;

final class TranslationField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null, $fieldsConfig = []): self
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setFormType(TranslationsType::class)
            ->setCssClass('field-translation')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setFormTypeOptions(
                [
                    'fields' => $fieldsConfig,
                    'constraints' => [
                        new Assert\Valid()
                    ],
                ]
            );
    }

    public function setRequired(bool $isRequired): self
    {
        $this->setFormTypeOption('required', $isRequired);
        return $this;
    }

    public function getBlockPrefix(): string
    {
        return 'translations';
    }
}