<?php

namespace App\Form\Field;

use App\Form\Type\ItemPropertiesChestRigType;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

class ItemPropertiesChestRigField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null, $fieldsConfig = []): ItemPropertiesChestRigField
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setFormType(ItemPropertiesChestRigType::class)
            ->setCssClass('field-properties-chest-rig')
            ->hideOnIndex()
            ->hideOnDetail()
        ;
    }
}