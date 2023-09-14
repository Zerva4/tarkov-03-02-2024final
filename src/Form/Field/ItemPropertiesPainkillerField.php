<?php

namespace App\Form\Field;

use App\Form\Type\ItemPropertiesPainkillerType;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

class ItemPropertiesPainkillerField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null, $fieldsConfig = []): ItemPropertiesPainkillerField
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setFormType(ItemPropertiesPainkillerType::class)
            ->setCssClass('field-properties-painkiller')
            ->hideOnIndex()
            ->hideOnDetail()
        ;
    }
}