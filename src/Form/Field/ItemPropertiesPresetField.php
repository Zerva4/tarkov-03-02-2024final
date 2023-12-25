<?php

namespace App\Form\Field;

use App\Form\Type\ItemPropertiesPresetType;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

class ItemPropertiesPresetField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null, $fieldsConfig = []): ItemPropertiesPresetField
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setFormType(ItemPropertiesPresetType::class)
            ->setCssClass('field-properties-preset')
            ->hideOnIndex()
            ->hideOnDetail()
            ;
    }
}