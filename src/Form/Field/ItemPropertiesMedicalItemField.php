<?php

declare(strict_types=1);

namespace App\Form\Field;

use App\Form\Type\ItemPropertiesMedicalItemType;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

class ItemPropertiesMedicalItemField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null, $fieldsConfig = []): ItemPropertiesMedicalItemField
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setFormType(ItemPropertiesMedicalItemType::class)
            ->setCssClass('field-properties-medical-item')
            ->hideOnIndex()
            ->hideOnDetail()
        ;
    }
}