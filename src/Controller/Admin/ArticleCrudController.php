<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\Field\TranslationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use function Symfony\Component\Translation\t;

class ArticleCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $createdAt = DateField::new('createdAt', t('Created', [], 'admin'));
        $updatedAt = DateField::new('updatedAt', t('Updated', [], 'admin'));
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
//            'tags' => [
        //        'label' => t('Tags', [], 'admin.articles')
//                'field_type' => TagsType::class
//            ],
        ];
        $translations = TranslationField::new('translations', t('Localization', [], 'admin.locations'), $translationFields)
            ->setFormTypeOptions([
                'excluded_fields' => ['lang', 'createdAt', 'updatedAt']
            ])
        ;

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $published,
                $poster->setColumns(6)->setTextAlign('left'),
                $translations
            ],
            default => [
                $title->setColumns(12)->setTextAlign('left'),
                $published->setColumns(1)->setTextAlign('center'),
                $createdAt->setColumns(1)->setTextAlign('center'),
                $updatedAt->setColumns(1)->setTextAlign('center'),
            ]
        };
    }
}
