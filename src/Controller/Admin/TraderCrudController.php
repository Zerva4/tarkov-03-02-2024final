<?php

namespace App\Controller\Admin;

use App\Entity\Trader;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
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
        $id = IntegerField::new('id', 'ID')->setColumns(0)->setTextAlign('left');
        $published = BooleanField::new('published', t('Published'));
        $fullName = TextField::new('fullName', t('Full name'));
        $characterType = TextField::new('characterType', t('Character type'));
        $uriName = TextField::new('uriName', t('URI-name'));
        $avatar = ImageField::new('imageName', t('Avatar'))
            ->setUploadDir($this->getParameter('app.traders.images.path'));

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $published, $fullName, $characterType, $uriName, $avatar
            ],
            default => [$id, $published, $fullName, $characterType],
        };
    }
}
