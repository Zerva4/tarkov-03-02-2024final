<?php

namespace App\Repository\Item;

use App\Entity\Item\ItemPropertiesBackpack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesBackpack>
 *
 * @method ItemPropertiesBackpack|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesBackpack|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesBackpack[]    findAll()
 * @method ItemPropertiesBackpack[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesBackpackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesBackpack::class);
    }

//    /**
//     * @return ItemPropertiesBackpack[] Returns an array of ItemPropertiesBackpack objects
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

//    public function findOneBySomeField($value): ?ItemPropertiesBackpack
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
