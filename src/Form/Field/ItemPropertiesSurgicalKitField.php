<?php

namespace App\Form\Field;

use App\Form\Type\ItemPropertiesSurgicalKitType;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

class ItemPropertiesSurgicalKitField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null, $fieldsConfig = []): ItemPropertiesSurgicalKitField
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setFormType(ItemPropertiesSurgicalKitType::class)
            ->setCssClass('field-properties-surgical-kit')
            ->hideOnIndex()
            ->hideOnDetail()
        ;
    }
}