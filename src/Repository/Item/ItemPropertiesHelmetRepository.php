<?php

declare(strict_types=1);

namespace App\Repository\Item;

use App\Entity\Item\Properties\ItemPropertiesHelmet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesHelmet>
 *
 * @method ItemPropertiesHelmet|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesHelmet|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesHelmet[]    findAll()
 * @method ItemPropertiesHelmet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesHelmetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesHelmet::class);
    }

//    /**
//     * @return ItemPropertiesHelmet[] Returns an array of ItemPropertiesHelmet objects
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

//    public function findOneBySomeField($value): ?ItemPropertiesHelmet
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
