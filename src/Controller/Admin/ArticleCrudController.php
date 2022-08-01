<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\Field\TagsInputField;
use App\Form\Type\TagsType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\DateTime;
use function Symfony\Component\Translation\t;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $id = IntegerField::new('id', 'ID')->setColumns(0)->setTextAlign('left');
        $createdAt = DateField::new('createdAt', t('Created', [], 'admin.articles'));
        $updatedAt = DateField::new('updatedAt', t('Updated', [], 'admin.articles'));
        $published = BooleanField::new('published', t('Published', [], 'admin.articles'));
        $title = TextField::new('title', t('Title', [], 'admin.articles'));
        $poster= ImageField::new('imagePoster', t('Poster', [], 'admin.articles'))
            ->setUploadDir($this->getParameter('app.articles.images.path'));
        $description  = TextEditorField::new('description', t('Description', [], 'admin.articles'));
        $body = TextEditorField::new('body', t('Description', [], 'admin.articles'));
        $tags = TagsInputField::new('tags', 'Теги')
            ->addCssFiles('assets/css/bootstrap-tagsinput.css')
            ->addJsFiles('assets/js/bootstrap-tagsinput.js')
            ->addJsFiles('assets/js/tags.js')
            ->setProperty('tags')
            ->setFormTypeOption('attr', [
                'data-role' => 'tagsinput',
            ])
//            ->setFormType(TagsType::class)
        ;

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $published,
                $createdAt->setColumns(6)->setTextAlign('left'),
                $updatedAt->setColumns(6)->setTextAlign('left'),
                $title->setColumns(6)->setTextAlign('left'),
                $poster->setColumns(6)->setTextAlign('left'),
                $description->setColumns(12)->setTextAlign('left'),
                $body->setColumns(12)->setTextAlign('left'),
                $tags
            ],
            default => [
                $id->setColumns(1)->setTextAlign('left'),
                $published->setColumns(1)->setTextAlign('left'),
                $createdAt,
                $updatedAt,
                $title->setColumns(12)
            ]
        };
    }
}
