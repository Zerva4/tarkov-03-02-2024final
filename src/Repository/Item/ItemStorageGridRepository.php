<?php

namespace App\Repository\Item;

use App\Entity\Item\ItemStorageGrid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemStorageGrid>
 *
 * @method ItemStorageGrid|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemStorageGrid|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemStorageGrid[]    findAll()
 * @method ItemStorageGrid[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemStorageGridRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemStorageGrid::class);
    }

//    /**
//     * @return ItemStorageGrid[] Returns an array of ItemStorageGrid objects
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

//    public function findOneBySomeField($value): ?ItemStorageGrid
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
