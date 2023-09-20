<?php

namespace App\Controller\Admin;

use App\Entity\Item\ItemCaliber;
use App\Form\Field\TranslationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use function Symfony\Component\Translation\t;

class ItemCaliberCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return ItemCaliber::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)->setSearchFields([
            'translations.name',
        ]);
    }

    public function configureFields(string $pageName): iterable
    {
        $published = BooleanField::new('published', t('Published', [], 'admin'));
        $createdAt = DateField::new('createdAt', t('Created', [], 'admin'));
        $updatedAt = DateField::new('updatedAt', t('Updated', [], 'admin'));
        $caliber = TextField::new('apiId', t('Caliber', [], 'admin.items_calibers'));
        $isAmmo = BooleanField::new('isAmmo', t('Is ammo', [], 'admin.items_calibers'));
        $slug = SlugField::new('slug', t('Slug', [], 'admin.items'))
            ->setTargetFieldName('slug')
            ->setRequired(true);
        $name = TextField::new('name', t('Name', [], 'admin.items_calibers'));
        $translationFields = [
            'name' => [
                'field_type' => TextType::class,
                'label' => t('Name', [], 'admin.items_calibers'),
            ]
        ];
        $translations = TranslationField::new('translations', t('Localization', [], 'admin'), $translationFields)
            ->setFormTypeOptions([
                'excluded_fields' => ['lang', 'createdAt', 'updatedAt']
            ])
        ;

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $published->setColumns(6),
                $isAmmo->setColumns(6),
                $caliber->setRequired(true)->setColumns(6),
                $slug->setRequired(true)->setColumns(6),
                $translations,
            ],
            default => [
                $name->setColumns(12)->setTextAlign('left')
                    ->setTemplatePath('admin/field/link-edit.html.twig'),
                $caliber,
                $published,
                $isAmmo,
                $createdAt,
                $updatedAt
            ],
        };
    }
}
