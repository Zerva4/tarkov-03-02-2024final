<?php

declare(strict_types=1);

namespace App\Form\Field;

use App\Form\Type\ItemPropertiesArmorType;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

class ItemPropertiesArmorField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null, $fieldsConfig = []): ItemPropertiesArmorField
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setFormType(ItemPropertiesArmorType::class)
            ->setCssClass('field-properties-armor')
            ->hideOnIndex()
            ->hideOnDetail()
        ;
    }
}