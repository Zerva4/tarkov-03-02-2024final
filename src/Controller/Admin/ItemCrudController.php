<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Item\Item;
use App\Form\Field\TranslationField;
use App\Form\Field\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use function Symfony\Component\Translation\t;

class ItemCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return Item::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)->setSearchFields([
            'translations.name',
        ]);
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name', t('Name', [], 'admin.items'));
        $published = BooleanField::new('published', t('Published', [], 'admin.items'));
        $itemImage = VichImageField::new('imageFile', t('Photo', [], 'admin.items')->getMessage())
            ->setTemplatePath('admin/field/vich_image.html.twig')
            ->setCustomOption('base_path', $this->getParameter('app.items.images.uri'))
            ->setFormTypeOption('required', false)
        ;
        $translationFields = [
            'name' => [
                'field_type' => TextType::class,
                'label' => t('Name', [], 'admin.items')
            ],
            'description' => [
                'attr' => [
                    'class' => 'ckeditor'
                ],
                'field_type' => CKEditorType::class,
                'label' => t('Description', [], 'admin.items')
            ],
        ];
        $translations = TranslationField::new('translations', t('Localization', [], 'admin.items'), $translationFields)
            ->setFormTypeOptions([
                'excluded_fields' => ['lang', 'createdAt', 'updatedAt']
            ])
        ;
        $slug = SlugField::new('slug', t('Slug', [], 'admin.items'))
            ->setTargetFieldName('slug')
            ->setRequired(true);

        // Базовые свойства
        $typeItem = TextField::new('type_item', t('Type item', [], 'admin.items'))->hideOnForm();
        $basePrice = IntegerField::new('base_price', t('Base price', [], 'admin.items'));
        $width = IntegerField::new('width', t('Width', [], 'admin.items'));
        $height = IntegerField::new('height', t('Height', [], 'admin.items'));
        $backgroundColor = TextField::new('background_color', t('Background color', [], 'admin.items'));
        $accuracyModifier = NumberField::new('accuracy_modifier', t('Accuracy modifier', [], 'admin.items'));
        $recoilModifier = NumberField::new('recoil_modifier', t('Recoil modifier', [], 'admin.items'));
        $hasGrid = BooleanField::new('has_grid', t('Has grid', [], 'admin.items'));
        $blocksHeadphones = BooleanField::new('blocks_headphones', t('Blocks headphones', [], 'admin.items'));
        $ergonomicsModifier = NumberField::new('ergonomics_modifier', t('Ergonomics modifier', [], 'admin.items'));
        $weight = NumberField::new('weight', t('Weight', [], 'admin.items'));
        dump($typeItem->getAsDto());

        // Доп свойства
        $properties = ArrayField::new('properties');

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                FormField::addTab(t('Basic', [], 'admin.items')),
                $typeItem,
                $itemImage,
                $slug,
                $published,
                $translations,
                FormField::addTab(t('Basic options', [], 'admin.items')),
                $hasGrid->setColumns(6),
                $blocksHeadphones->setColumns(6),
                $basePrice->setColumns(2),
                $width->setColumns(2),
                $height->setColumns(2),
                $backgroundColor->setColumns(3),
//                $accuracyModifier->setColumns(3),
//                $recoilModifier->setColumns(3),
//                $ergonomicsModifier->setColumns(3),
                $weight->setColumns(3),
                FormField::addTab(t('Extra options', [], 'admin.items')),
//                $properties->setColumns(12)
            ],
            default => [
                $name->setColumns(12)->setTextAlign('left')
                    ->setTemplatePath('admin/field/link-edit.html.twig'),
                $typeItem->setTemplatePath('admin/field/item-type.html.twig'),
                $published->setColumns(1)->setTextAlign('center'),
                DateField::new('createdAt', t('Created', [], 'admin'))->setTextAlign('center'),
                DateField::new('updatedAt', t('Updated', [], 'admin'))->setTextAlign('center'),
            ]
        };
    }
}
