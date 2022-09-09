<?php

namespace App\Controller\Admin;

use App\Entity\Item;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use function Symfony\Component\Translation\t;

class ItemCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Item::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $title = TextField::new('title', t('Title', [], 'admin.maps'));
        $published = BooleanField::new('published', t('Published', [], 'admin.maps'));

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                FormField::addTab(t('Basic', [], 'admin.maps')),
                $published,
            ],
            default => [
                $title->setColumns(12)->setTextAlign('left'),
                $published->setColumns(1)->setTextAlign('center'),
                DateField::new('createdAt', t('Created', [], 'admin'))->setTextAlign('center'),
                DateField::new('updatedAt', t('Updated', [], 'admin'))->setTextAlign('center'),
            ]
        };
    }
}
