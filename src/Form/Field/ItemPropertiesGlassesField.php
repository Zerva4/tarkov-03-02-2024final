<?php

declare(strict_types=1);

namespace App\Form\Field;

use App\Form\Type\ItemPropertiesGlassesType;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

class ItemPropertiesGlassesField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null, $fieldsConfig = []): ItemPropertiesGlassesField
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setFormType(ItemPropertiesGlassesType::class)
            ->setCssClass('field-properties-glasses')
            ->hideOnIndex()
            ->hideOnDetail()
        ;
    }
}