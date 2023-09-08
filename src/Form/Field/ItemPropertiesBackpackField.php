<?php

namespace App\Form\Field;

use App\Form\Type\ItemPropertiesBackpackType;
use App\Form\Type\ItemPropertiesMeleeType;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

class ItemPropertiesBackpackField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null, $fieldsConfig = []): ItemPropertiesBackpackField
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setFormType(ItemPropertiesBackpackType::class)
            ->setCssClass('field-properties-backpack')
            ->hideOnIndex()
            ->hideOnDetail()
        ;
    }
}