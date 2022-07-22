<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
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
            ->setUploadDir($this->getParameter('app.locations.images.path'));
        $description  = TextEditorField::new('description', t('Description', [], 'admin.articles'));
        $body  = TextEditorField::new('body', t('Description', [], 'admin.articles'));

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $published->setColumns(1)->setTextAlign('left'),
                $createdAt,
                $updatedAt,
                $title,
                $poster,
                $description,
                $body,
            ],
            default => [
                $id->setColumns(1)->setTextAlign('left'),
                $published->setColumns(1)->setTextAlign('left'),
                $createdAt,
                $updatedAt,
                $title->setColumns(12)
            ]
        };
        return [
            $id, $published, $title
        ];
    }
}
