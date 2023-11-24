<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Item\Item;
use App\Entity\Trader\TraderCashOffer;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use function Symfony\Component\Translation\t;

class TraderCashOfferCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TraderCashOffer::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $createdAt = DateField::new('createdAt', t('Created', [], 'admin'))->setTextAlign('center');
        $updatedAt = DateField::new('updatedAt', t('Updated', [], 'admin'))->setTextAlign('center');
        $item = AssociationField::new('item', t('Item', [], 'admin.cash.offer'))->autocomplete();
        $trader = AssociationField::new('trader', t('Trader', [], 'admin.cash.offer'))->autocomplete();
        $traderLevel = AssociationField::new('traderLevel', t('Trader level', [], 'admin.cash.offer'));
        $price = IntegerField::new('price', t('Price', [], 'admin.cash.offer'));
        $priceRUB = IntegerField::new('priceRUB', t('Price RUB', [], 'admin.cash.offer'));
        $currency = TextField::new('currency', t('Currency title', [], 'admin.cash.offer'));
        $currencyItem = AssociationField::new('currencyItem', t('Currency item', [], 'admin.cash.offer'))
            ->setFormTypeOption('query_builder', function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('i')
                        ->andWhere('i.apiId IN (:ids)')
                        ->setParameter('ids', ['5449016a4bdc2d6f028b456f', '5696686a4bdc2da3298b456a', '569668774bdc2da2298b4568']);
            })
//            ->autocomplete()
            ->setFormTypeOptions(['by_reference' => true])
        ;
        $questUnlock = AssociationField::new('questUnlock', t('Quest unlock', [], 'admin.cash.offer'))
            ->setRequired(false)
            ->autocomplete();

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $trader->setColumns(6),
                $traderLevel->setColumns(6),
                $item->setColumns(6),
                $currencyItem->setColumns(6),
                $currency->setColumns(6),
                $questUnlock->setColumns(6),
                $price->setColumns(6),
                $priceRUB->setColumns(6)
            ],
            default => [
                $item,
                $trader,
                $traderLevel,
                $currencyItem,
                $price,
                $questUnlock,
                $createdAt,
                $updatedAt
            ]
        };
    }

}
