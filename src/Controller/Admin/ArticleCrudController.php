<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\Field\TranslationField;
use App\Form\Field\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
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
        $poster = VichImageField::new('imageFile', t('Photo', [], 'admin.locations')->getMessage())
            ->setTemplatePath('admin/field/vich_image.html.twig')
            ->setCustomOption('base_path', $this->getParameter('app.articles.images.uri'))
            ->setFormTypeOption('required', false);
        ;
        $slug = TextField::new('slug', t('Slug', [], 'admin.articles'))->setRequired(true);
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
                $poster,
                $published,
                $slug->setColumns(6),
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
