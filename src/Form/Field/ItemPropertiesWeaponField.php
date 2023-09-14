<?php

namespace App\Form\Field;

use App\Form\Type\ItemPropertiesWeaponType;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

class ItemPropertiesWeaponField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null, $fieldsConfig = []): ItemPropertiesWeaponField
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setFormType(ItemPropertiesWeaponType::class)
            ->setCssClass('field-properties-weapon')
            ->hideOnIndex()
            ->hideOnDetail()
        ;
    }
}