<?php

namespace App\Controller\Admin;

use App\Entity\Article\ArticleCategory;
use App\Form\Field\TranslationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use function Symfony\Component\Translation\t;

class ArticleCategoryCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return ArticleCategory::class;
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
        $type = ChoiceField::new('type', t('Type', [], 'admin.articles'))
            ->setChoices([
                'Mechanics' => '0',
                'Update' => '1'
            ])
            ->setRequired(true)
        ;
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
                $type->setColumns(6),
                $slug->setColumns(6)->setDisabled(false),
                $translations,
            ],
            default => [
                $name->setTemplatePath('admin/field/link-edit.html.twig'),
                $published, $type, $createdAt, $updatedAt],
        };
    }
}
