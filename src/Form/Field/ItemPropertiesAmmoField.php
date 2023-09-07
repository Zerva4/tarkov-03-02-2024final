<?php

namespace App\Form\Field;

use App\Form\Type\ItemPropertiesAmmoType;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

class ItemPropertiesAmmoField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null, $fieldsConfig = []): ItemPropertiesAmmoField
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setTemplatePath('crud/field/text')
            ->setFormType(ItemPropertiesAmmoType::class)
            ->setCssClass('field-properties-ammo')
            ->hideOnIndex()
            ->hideOnDetail()
        ;
    }
}