<?php

declare(strict_types=1);

namespace App\Form\Field;

use App\Form\Type\ItemPropertiesHelmetType;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

class ItemPropertiesHelmetField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null, $fieldsConfig = []): ItemPropertiesHelmetField
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setFormType(ItemPropertiesHelmetType::class)
            ->setCssClass('field-properties-helmet')
            ->hideOnIndex()
            ->hideOnDetail()
        ;
    }
}