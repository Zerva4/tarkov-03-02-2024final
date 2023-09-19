<?php

namespace App\Repository\Item;

use App\Entity\Item\ItemCaliber;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemCaliber>
 *
 * @method ItemCaliber|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemCaliber|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemCaliber[]    findAll()
 * @method ItemCaliber[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemCaliberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemCaliber::class);
    }

//    /**
//     * @return ItemCaliber[] Returns an array of ItemCaliber objects
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

//    public function findOneBySomeField($value): ?ItemCaliber
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
