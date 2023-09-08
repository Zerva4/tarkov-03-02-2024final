<?php

namespace App\Form\Field;

use App\Form\Type\ItemPropertiesContainerType;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

class ItemPropertiesContainerField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null, $fieldsConfig = []): ItemPropertiesContainerField
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setTemplatePath('admin/field/properties-melee.html.twig')
            ->setFormType(ItemPropertiesContainerType::class)
            ->setCssClass('field-properties-melee')
            ->hideOnIndex()
            ->hideOnDetail()
        ;
    }
}