<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\Field\TagsInputField;
use App\Form\Field\TranslationField;
use App\Form\Type\TagsType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use function Symfony\Component\Translation\t;

class ArticleCrudController extends AbstractCrudController
{
    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setFormThemes([
                'admin/field/translation.html.twig',
                '@EasyAdmin/crud/form_theme.html.twig',
                '@FOSCKEditor/Form/ckeditor_widget.html.twig',
            ])
            ;
    }

    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $createdAt = DateField::new('createdAt', t('Created', [], 'admin.articles'));
        $updatedAt = DateField::new('updatedAt', t('Updated', [], 'admin.articles'));
        $published = BooleanField::new('published', t('Published', [], 'admin.articles'));
        $title = TextField::new('title', t('Title', [], 'admin.articles'));
        $poster= ImageField::new('imagePoster', t('Poster', [], 'admin.articles'))
            ->setUploadDir($this->getParameter('app.articles.images.path'));
//        $description  = TextEditorField::new('description', t('Description', [], 'admin.articles'));
//        $body = TextEditorField::new('body', t('Description', [], 'admin.articles'));
//        $tags = TagsInputField::new('tags', 'Теги')
//            ->addCssFiles('assets/css/bootstrap-tagsinput.css')
//            ->addJsFiles('assets/js/bootstrap-tagsinput.js')
//            ->addJsFiles('assets/js/tags.js')
//            ->setProperty('tags')
//            ->setFormTypeOption('attr', [
//                'data-role' => 'tagsinput',
//            ])
//            ->setFormType(TagsType::class)
        ;

        $translationFields = [
            'title' => [
                'field_type' => TextType::class
            ],
            'description' => [
                'attr' => [
                    'class' => 'ckeditor'
                ],
                'field_type' => CKEditorType::class
            ],
            'body' => [
                'attr' => [
                    'class' => 'ckeditor'
                ],
                'field_type' => CKEditorType::class
            ],
//            'tags' => [
//                'field_type' => TagsType::class
//            ],
        ];
        $translations = TranslationField::new('translations', (string)t('Localization', [], 'admin.locations'), $translationFields)
            ->setFormTypeOptions([
                'excluded_fields' => ['lang']
            ])
        ;

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $published,
                $createdAt->setColumns(6)->setTextAlign('left'),
                $updatedAt->setColumns(6)->setTextAlign('left'),
                $poster->setColumns(6)->setTextAlign('left'),
                $translations
            ],
            default => [
                $published->setColumns(1)->setTextAlign('left'),
                $createdAt,
                $updatedAt,
                $title->setColumns(12)
            ]
        };
    }
}
