<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Item\Item;
use App\Entity\Item\ItemPropertiesAmmo;
use App\Filter\ItemPropertiesFilter;
use App\Form\Field\ItemPropertiesAmmoField;
use App\Form\Field\TranslationField;
use App\Form\Field\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RequestStack;
use function Symfony\Component\Translation\t;

class ItemCrudController extends BaseCrudController
{
    public function __construct(
        protected RequestStack $requestStack,
    ) {
    }

    public static function getEntityFqcn(): string
    {
        return Item::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters->add(ItemPropertiesFilter::new('typeItem', t('Type item', [], 'admin.items')));
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)->setSearchFields([
            'translations.name',
        ]);
    }

    public function configureFields(string $pageName): iterable
    {
        $itemClassName = 'App\Form\Field\\'.$this->requestStack->getCurrentRequest()->query->get('typeItem').'Field';

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
            'shortName' => [
                'field_type' => TextType::class,
                'label' => t('Short name', [], 'admin.items')
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
        $typeItem = HiddenField::new('type_item', t('Type item', [], 'admin.items'));
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

        $form = [
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
            $weight->setColumns(3),
        ];

        if ($itemClassName !== 'App\Form\Field\ItemPropertiesDefaultField' && $pageName === Crud::PAGE_EDIT) {
            $properties = $itemClassName::new('properties')->setLabel(false)->setColumns(12);
            $form[] = FormField::addTab(t('Extra options', [], 'admin.items'));
            $form[] = $properties;
        }

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => $form,
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
