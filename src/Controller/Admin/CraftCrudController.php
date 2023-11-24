<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Workshop\Craft;
use App\Form\ContainedItemForm;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use function Symfony\Component\Translation\t;

class CraftCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Craft::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $createdAt = DateField::new('createdAt', t('Created', [], 'admin'))->setTextAlign('center');
        $updatedAt = DateField::new('updatedAt', t('Updated', [], 'admin'))->setTextAlign('center');
        $published = BooleanField::new('published', t('Published', [], 'admin'));
        $place = AssociationField::new('place', t('Place', [], 'admin.crafts'))
            ->autocomplete()
        ;
        $level = IntegerField::new('level', t('Level', [], 'admin.crafts'))
            ->setTextAlign('center')
        ;
        $duration = IntegerField::new('duration', t('Duration', [], 'admin.crafts'))
            ->setTextAlign('center')
        ;
        $unlockQuest = AssociationField::new('unlockQuest', t('Unlock quest', [], 'admin.crafts'))
            ->autocomplete()
            ->setRequired(false)
        ;
        $requiredContainedItems = CollectionField::new('requiredContainedItems', t('Required items', [], 'admin.crafts'))
            ->allowAdd()
            ->allowDelete()
            ->setEntryType(ContainedItemForm::class)
            ->setEntryIsComplex(false)
            ->setFormTypeOption('by_reference', true)
        ;
        $requiredQuestItems = CollectionField::new('requiredQuestItems', t('Required quest items', [], 'admin.crafts'))
            ->allowAdd()
            ->allowDelete()
//            ->setEntryType(ContainedItemForm::class)
            ->setEntryIsComplex(false)
            ->setFormTypeOption('by_reference', true)
        ;
        $rewardContainedItems = CollectionField::new('rewardContainedItems', t('Reward items', [], 'admin.crafts'))
            ->allowAdd()
            ->allowDelete()
            ->setEntryType(ContainedItemForm::class)
            ->setEntryIsComplex(false)
            ->setFormTypeOption('by_reference', true)
        ;
        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $published,
                $place->setColumns(3),
                $level->setColumns(3),
                $duration->setColumns(3),
                $unlockQuest->setColumns(3),
                $requiredContainedItems->setColumns(4),
                $requiredQuestItems->setColumns(4),
                $rewardContainedItems->setColumns(4)
            ],
            default => [
                $published,
                $place->setTextAlign('left')->setTemplatePath('admin/field/link-edit.html.twig'),
                $unlockQuest,
                $level,
                $duration,
                $createdAt,
                $updatedAt
            ]
        };
    }
}
