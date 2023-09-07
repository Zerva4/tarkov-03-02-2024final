<?php

namespace App\Form\Field;

use App\Form\Type\ItemPropertiesMeleeType;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

class ItemPropertiesMeleeField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null, $fieldsConfig = []): ItemPropertiesMeleeField
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setTemplatePath('admin/field/properties-melee.html.twig')
            ->setFormType(ItemPropertiesMeleeType::class)
            ->setCssClass('field-properties-melee')
            ->hideOnIndex()
            ->hideOnDetail()
        ;
    }

//    public function getAsDto(): FieldDto
//    {
//        // TODO: Implement getAsDto() method.
//    }
}