<?php

namespace App\Controller\Admin;

use App\Entity\Location;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use function Symfony\Component\Translation\t;

class LocationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Location::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $id = IntegerField::new('id', 'ID')->setColumns(0)->setTextAlign('left');
        $published = BooleanField::new('published', t('Published', [], 'admin.locations'));
        $title = TextField::new('title', t('Title', [], 'admin.locations'));
        $locationImage= ImageField::new('imageName', t('Photo', [], 'admin.locations'))
            ->setUploadDir($this->getParameter('app.locations.images.path'));
        $numberOfPlayers = TextField::new('numberOfPlayers', t('Number of players', [], 'admin.locations'));
        $raidDuration = NumberField::new('raidDuration', t('Raid duration', [], 'admin.locations'));
        $description  = TextEditorField::new('description', t('Description', [], 'admin.locations'));

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $published,
                $title->setColumns(6),
                $locationImage->setColumns(6),
                $numberOfPlayers->setColumns(6),
                $raidDuration->setColumns(6),
                $description->setColumns(12)->setTextAlign('left')
            ],
            default => [
                $id->setColumns(1)->setTextAlign('left'),
                $published->setColumns(1)->setTextAlign('left'),
                $title->setColumns(6)->setTextAlign('left'),
                $numberOfPlayers->setColumns(2)->setTextAlign('left'),
                $raidDuration->setColumns(2)->setTextAlign('left')
            ]
        };
    }
}
