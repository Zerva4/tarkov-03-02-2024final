<?php

namespace App\Repository\Item;

use App\Entity\Item\ItemPropertiesMelee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesMelee>
 *
 * @method ItemPropertiesMelee|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesMelee|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesMelee[]    findAll()
 * @method ItemPropertiesMelee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesMeleeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesMelee::class);
    }

//    /**
//     * @return ItemPropertiesMelee[] Returns an array of ItemPropertiesMelee objects
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

//    public function findOneBySomeField($value): ?ItemPropertiesMelee
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
