<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Barter;
use App\Form\ContainedItemForm;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use function Symfony\Component\Translation\t;

class BarterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Barter::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $published = BooleanField::new('published', t('Published', [], 'admin.barters'));
        $createdAt = DateField::new('createdAt', 'Created')->setTextAlign('center');
        $updatedAt = DateField::new('updatedAt', 'Updated')->setTextAlign('center');
        $traderLevel = IntegerField::new('traderLevel', t('Trader level', [], 'admin.barters'))
            ->setTextAlign('center')
        ;
        $trader = AssociationField::new('trader', t('Trader', [], 'admin.barters'))
            ->autocomplete()
        ;
        $questUnlock= AssociationField::new('unlockInQuest', t('Quest unlock', [], 'admin.barters'))
            ->autocomplete()
            ->setRequired(false)
        ;
        $requiredItems = CollectionField::new('requiredItems', t('Required items', [], 'admin.barters'))
            ->allowAdd()
            ->allowDelete()
            ->setEntryType(ContainedItemForm::class)
            ->setEntryIsComplex(false)
            ->setFormTypeOption('by_reference', true)
        ;
        $rewardItems = CollectionField::new('rewardItems', t('Reward items', [], 'admin.barters'))
            ->allowAdd()
            ->allowDelete()
            ->setEntryType(ContainedItemForm::class)
            ->setEntryIsComplex(false)
            ->setFormTypeOption('by_reference', true)
        ;

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $published,
                $trader->setColumns(4),
                $traderLevel->setColumns(4),
                $questUnlock->setColumns(4),
                $requiredItems->setColumns(6),
                $rewardItems->setColumns(6)
            ],
            default => [
                $published,
                $trader,
                $traderLevel,
                $rewardItems,
                $questUnlock,
                $createdAt,
                $updatedAt
            ]
        };
    }
}
