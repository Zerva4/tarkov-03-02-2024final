<?php

declare(strict_types=1);

namespace App\Repository\Item;

use App\Entity\Item\Properties\ItemPropertiesSurgicalKit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesSurgicalKit>
 *
 * @method ItemPropertiesSurgicalKit|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesSurgicalKit|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesSurgicalKit[]    findAll()
 * @method ItemPropertiesSurgicalKit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesSurgicalKitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesSurgicalKit::class);
    }

//    /**
//     * @return ItemPropertiesSurgicalKit[] Returns an array of ItemPropertiesSurgicalKit objects
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

//    public function findOneBySomeField($value): ?ItemPropertiesSurgicalKit
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
