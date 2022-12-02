<?php

namespace App\Controller\Admin;

use App\Entity\ItemMaterial;
use App\Form\Field\TranslationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use function Symfony\Component\Translation\t;

class ItemMaterialCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return ItemMaterial::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $published = BooleanField::new('published', t('Published', [], 'admin'));
        $createdAt = DateField::new('createdAt', t('Created', [], 'admin'));
        $updatedAt = DateField::new('updatedAt', t('Updated', [], 'admin'));
        $title = TextField::new('title', t('Title', [], 'admin.items_materials'));
        $destructibility = NumberField::new('destructibility', t('Destructibility', [], 'admin.items_materials'));
        $minRepairDegradation = NumberField::new('minRepairDegradation', t('Min Repair Degradation', [], 'admin.items_materials'));
        $maxRepairDegradation = NumberField::new('maxRepairDegradation', t('Max Repair Degradation', [], 'admin.items_materials'));
        $explosionDestructibility = NumberField::new('explosionDestructibility', t('Explosion Destructibility', [], 'admin.items_materials'));
        $minRepairKitDegradation = NumberField::new('minRepairKitDegradation', t('Min Repair Kit Degradation', [], 'admin.items_materials'));
        $maxRepairKitDegradation = NumberField::new('maxRepairKitDegradation', t('Max Repair Kit Degradation', [], 'admin.items_materials'));
        $translationFields = [
            'title' => [
                'field_type' => TextType::class,
                'label' => t('Title', [], 'admin.items_materials'),
            ]
        ];
        $translations = TranslationField::new('translations', t('Localization', [], 'admin'), $translationFields)
            ->setFormTypeOptions([
                'excluded_fields' => ['lang', 'createdAt', 'updatedAt']
            ])
        ;

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $published,
                $translations,
                $destructibility->setRequired(true)->setColumns(4),
                $minRepairDegradation->setRequired(true)->setColumns(4),
                $maxRepairDegradation->setRequired(true)->setColumns(4),
                $explosionDestructibility->setRequired(true)->setColumns(4),
                $minRepairKitDegradation->setRequired(true)->setColumns(4),
                $maxRepairKitDegradation->setRequired(true)->setColumns(4)
            ],
            default => [$title, $published, $createdAt, $updatedAt],
        };
    }
}
