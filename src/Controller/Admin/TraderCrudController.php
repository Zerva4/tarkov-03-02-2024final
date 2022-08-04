<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Trader;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use function Symfony\Component\Translation\t;

class TraderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Trader::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $published = BooleanField::new('published', t('Published', [], 'admin.traders'));
        $fullName = TextField::new('fullName', t('Full name', [], 'admin.traders'));
        $characterType = TextField::new('characterType', t('Character type', [], 'admin.traders'));
        $uriName = TextField::new('uriName', t('URI-name', [], 'admin.traders'));
        $avatar = ImageField::new('imageName', t('Photo', [], 'admin.traders'))
            ->setUploadDir($this->getParameter('app.traders.images.path'));

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $published,
                $fullName->setColumns(6)->setTextAlign('left'),
                $characterType->setColumns(6)->setTextAlign('left'),
                $uriName->setColumns(6)->setTextAlign('left'),
                $avatar->setColumns(6)->setTextAlign('left')
            ],
            default => [$characterType, $published, $fullName],
        };
    }
}
