<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemPropertiesFilterType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => [
                'Разное' => 'ItemDefaultProperty',
                'Патрон' => 'ItemPropertiesAmmo',
                'Броня' => 'ItemPropertiesArmor',
                'Рюкзак' => 'ItemPropertiesBackpack',
                'Оружейный ствол' => 'ItemPropertiesBarrel',
                'Разгрузочный жилет' => 'ItemPropertiesChestRig',
                'Контейнер' => 'ItemPropertiesContainer',
                'Продукт' => 'ItemPropertiesFoodDrink',
                'Очки' => 'ItemPropertiesGlasses',
                'Граната' => 'ItemPropertiesGrenade',
                'Наушник' => 'ItemPropertiesHeadphone',
                'Шлем' => 'ItemPropertiesHelmet',
                'Ключ' => 'ItemPropertiesKey',
                'Магазин' => 'ItemPropertiesMagazine',
                'Медицинский предмет' => 'ItemPropertiesMedicalItem',
                'Аптечка' => 'ItemPropertiesMedKit',
                'Холодное оружие' => 'ItemPropertiesMelee',
                'Прибор ночного видения' => 'ItemPropertiesNightVision',
                'Обезбаливающее' => 'ItemPropertiesPainkiller',
                'Прицел' => 'ItemPropertiesScope',
                'Хирургический набор' => 'ItemPropertiesSurgicalKit',
                'Огнестрельное оружие' => 'ItemPropertiesWeapon',
                'Модификатор оружия' => 'ItemPropertiesWeaponMod',
            ],
        ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }
}
