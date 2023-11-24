<?php

declare(strict_types=1);

namespace App\Repository\Item;

use App\Entity\Item\Properties\ItemPropertiesMedKit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesMedKit>
 *
 * @method ItemPropertiesMedKit|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesMedKit|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesMedKit[]    findAll()
 * @method ItemPropertiesMedKit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesMedKitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesMedKit::class);
    }

//    /**
//     * @return ItemPropertiesMedKit[] Returns an array of ItemPropertiesMedKit objects
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

//    public function findOneBySomeField($value): ?ItemPropertiesMedKit
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
