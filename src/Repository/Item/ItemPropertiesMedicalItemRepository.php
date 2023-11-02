<?php

declare(strict_types=1);

namespace App\Repository\Item;

use App\Entity\Item\Properties\ItemPropertiesMedicalItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesMedicalItem>
 *
 * @method ItemPropertiesMedicalItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesMedicalItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesMedicalItem[]    findAll()
 * @method ItemPropertiesMedicalItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesMedicalItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesMedicalItem::class);
    }

//    /**
//     * @return ItemPropertiesMedicalItem[] Returns an array of ItemPropertiesMedicalItem objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ItemPropertiesMedicalItem
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
