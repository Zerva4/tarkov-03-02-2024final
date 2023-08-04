<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Update\Update;
use App\Form\Field\TranslationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use function Symfony\Component\Translation\t;

class UpdateCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return Update::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)->setSearchFields([
            'translations.description']
        )->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        $createdAt = DateField::new('createdAt', 'Created');
        $updatedAt = DateField::new('updatedAt', 'Updated');
        $dateAdded = DateField::new('dateAdded', 'Updated');
        $slug = SlugField::new('slug', t('Slug', [], 'admin'))
            ->setTargetFieldName('slug')
            ->setRequired(true);
        $description = TextareaField::new('description', t('Description', [], 'admin'));
        $category = AssociationField::new('category', t('Category', [], 'admin'))
            ->setQueryBuilder(function($queryBuilder) {
                return $queryBuilder->join('entity.translations', 'lt', 'WITH', 'entity.id = lt.translatable')
                    ->addSelect('lt')
                    ->andWhere('lt.locale = :locale')
                    ->setParameter('locale', $this->container->get('request_stack')->getCurrentRequest()->getLocale())
                    ;
            })
            ->setColumns(12)
        ;
        $translationFields = [
            'title' => [
                'field_type' => TextType::class,
                'label' => t('Name', [], 'admin'),
            ],
            'description' => [
                'field_type' => CKEditorType::class,
                'label' => t('Description', [], 'admin'),
            ],
        ];

        $translations = TranslationField::new('translations', t('Localization', [], 'admin'), $translationFields)
            ->setFormTypeOptions([
                'excluded_fields' => ['slug','lang', 'createdAt', 'updatedAt']
            ])
        ;

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $dateAdded->setColumns(2),
                $category->setColumns(5),
                $slug->setColumns(5),
                $translations,
            ],
            default => [
                $description->setTemplatePath('admin/field/link-edit.html.twig'),
                $category,
                $createdAt, $updatedAt],
        };
    }
}
