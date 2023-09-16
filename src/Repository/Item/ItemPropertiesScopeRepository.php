<?php

declare(strict_types=1);

namespace App\Repository\Item;

use App\Entity\Item\ItemPropertiesScope;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesScope>
 *
 * @method ItemPropertiesScope|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesScope|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesScope[]    findAll()
 * @method ItemPropertiesScope[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesScopeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesScope::class);
    }

//    /**
//     * @return ItemPropertiesScope[] Returns an array of ItemPropertiesScope objects
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

//    public function findOneBySomeField($value): ?ItemPropertiesScope
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
