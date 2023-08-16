<?php

namespace App\Controller\Admin;

use App\Entity\Update\UpdateCategory;
use App\Form\Field\TranslationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use function Symfony\Component\Translation\t;

class UpdateCategoryCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return UpdateCategory::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)->setSearchFields([
            'translations.name'
        ]);
    }

    public function configureFields(string $pageName): iterable
    {
        $createdAt = DateField::new('createdAt', 'Created');
        $updatedAt = DateField::new('updatedAt', 'Updated');
        $published = BooleanField::new('published', t('Published', [], 'admin'));
        $slug = SlugField::new('slug', t('Slug', [], 'admin'))
            ->setTargetFieldName('slug')
            ->setDisabled(false)
        ;
        $name = TextField::new('name', t('Name', [], 'admin'));
        $translationFields = [
            'name' => [
                'field_type' => TextType::class,
                'label' => t('Name', [], 'admin'),
            ],
        ];

        $translations = TranslationField::new('translations', t('Localization', [], 'admin'), $translationFields)
            ->setFormTypeOptions([
                'excluded_fields' => ['lang', 'createdAt', 'updatedAt']
            ])
        ;

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $published,
                $slug->setColumns(12)->setDisabled(false),
                $translations,
            ],
            default => [
                $name->setTemplatePath('admin/field/link-edit.html.twig'),
                $published, $createdAt, $updatedAt],
        };
    }
}
