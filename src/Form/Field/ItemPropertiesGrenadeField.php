<?php

namespace App\Form\Field;

use App\Form\Type\ItemPropertiesGrenadeType;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

class ItemPropertiesGrenadeField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null, $fieldsConfig = []): ItemPropertiesGrenadeField
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setFormType(ItemPropertiesGrenadeType::class)
            ->setCssClass('field-properties-grenade')
            ->hideOnIndex()
            ->hideOnDetail()
        ;
    }
}