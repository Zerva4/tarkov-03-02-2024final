<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Article\Article;
use App\Entity\Article\ArticleCategory;
use App\Form\Field\TranslationField;
use App\Form\Field\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use function Symfony\Component\Translation\t;

class ArticleCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)->setSearchFields([
            'translations.title',
        ]);
    }

    public function configureFields(string $pageName): iterable
    {
        $createdAt = DateField::new('createdAt', t('Created', [], 'admin'));
        $updatedAt = DateField::new('updatedAt', t('Updated', [], 'admin'));
        $complexity = IntegerField::new('complexity', t('Complexity', [], 'admin.articles'));
        $readingDuration = TimeField::new('readingDuration', t('Reading duration', [], 'admin.articles'));
        $status = ChoiceField::new('status', t('Status', [], 'admin.articles'))
            ->setChoices([
                'На рассмотрении' => 0,
                'К публикации' => 1,
                'Опубликованно' => 2,
                'Архивная' => 3
            ])
            ->renderAsBadges()
            ->setEmptyData('Не заданно')
        ;
        $title = TextField::new('title', t('Title', [], 'admin.articles'));
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
        $poster = VichImageField::new('imageFile', t('Photo', [], 'admin.locations')->getMessage())
            ->setTemplatePath('admin/field/vich_image.html.twig')
            ->setCustomOption('base_path', $this->getParameter('app.articles.images.uri'))
            ->setFormTypeOption('required', false);
        ;
        $slug = SlugField::new('slug', t('Slug', [], 'admin'))
            ->setTargetFieldName('slug')
            ->setRequired(true);
        $translationFields = [
            'title' => [
                'field_type' => TextType::class,
                'label' => t('Title', [], 'admin.articles')
            ],
            'description' => [
                'attr' => [
                    'class' => 'ckeditor'
                ],
                'field_type' => CKEditorType::class,
                'label' => t('Description', [], 'admin.articles')
            ],
            'body' => [
                'attr' => [
                    'class' => 'ckeditor'
                ],
                'field_type' => CKEditorType::class,
                'label' => t('Body', [], 'admin.articles')
            ],
        ];
        $translations = TranslationField::new('translations', t('Localization', [], 'admin'), $translationFields)
            ->setFormTypeOptions([
                'excluded_fields' => ['lang', 'createdAt', 'updatedAt']
            ])
        ;

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $poster,
                $status->setColumns(2),
                $category->setColumns(2),
                $complexity->setColumns(2),
                $readingDuration->setColumns(2),
                $slug->setColumns(4),
                $translations
            ],
            default => [
                $title->setColumns(12)->setTextAlign('left'),
                $status,
                $category,
                $createdAt->setColumns(1)->setTextAlign('center'),
                $updatedAt->setColumns(1)->setTextAlign('center'),
            ]
        };
    }
}
