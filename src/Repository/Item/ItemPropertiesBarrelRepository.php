<?php

declare(strict_types=1);

namespace App\Repository\Item;

use App\Entity\Item\Properties\ItemPropertiesBarrel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesBarrel>
 *
 * @method ItemPropertiesBarrel|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesBarrel|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesBarrel[]    findAll()
 * @method ItemPropertiesBarrel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesBarrelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesBarrel::class);
    }

//    /**
//     * @return ItemPropertiesBarrel[] Returns an array of ItemPropertiesBarrel objects
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

//    public function findOneBySomeField($value): ?ItemPropertiesBarrel
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
