<?php

namespace App\Controller\Admin;

use App\Entity\Items\Item;
use App\Form\Field\TranslationField;
use App\Form\Field\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
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
            'translations.title',
        ]);
    }

    public function configureFields(string $pageName): iterable
    {
        $title = TextField::new('title', t('Title', [], 'admin.items'));
        $published = BooleanField::new('published', t('Published', [], 'admin.items'));
        $itemImage = VichImageField::new('imageFile', t('Photo', [], 'admin.items')->getMessage())
            ->setTemplatePath('admin/field/vich_image.html.twig')
            ->setCustomOption('base_path', $this->getParameter('app.items.images.uri'))
            ->setFormTypeOption('required', false)
        ;
        $translationFields = [
            'title' => [
                'field_type' => TextType::class,
                'label' => t('Title', [], 'admin.items')
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
        $velocity = NumberField::new('velocity', t('Velocity', [], 'admin.items'));
        $loudness = IntegerField::new('loudness', t('Loudness', [], 'admin.items'));

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                FormField::addTab(t('Basic', [], 'admin.items')),
                $itemImage,
                $slug,
                $published,
                $translations,
                FormField::addTab(t('Basic options', [], 'admin.items')),
                $hasGrid->setColumns(6),
                $blocksHeadphones->setColumns(6),
                $basePrice->setColumns(3),
                $width->setColumns(3),
                $height->setColumns(3),
                $backgroundColor->setColumns(3),
                $accuracyModifier->setColumns(3),
                $recoilModifier->setColumns(3),
                $ergonomicsModifier->setColumns(3),
                $weight->setColumns(3),
                $velocity->setColumns(3),
                $loudness->setColumns(3),
                FormField::addTab(t('Extra options', [], 'admin.items')),
            ],
            default => [
                $title->setColumns(12)->setTextAlign('left')
                    ->setTemplatePath('admin/field/link-edit.html.twig'),
                $published->setColumns(1)->setTextAlign('center'),
                DateField::new('createdAt', t('Created', [], 'admin'))->setTextAlign('center'),
                DateField::new('updatedAt', t('Updated', [], 'admin'))->setTextAlign('center'),
            ]
        };
    }
}
