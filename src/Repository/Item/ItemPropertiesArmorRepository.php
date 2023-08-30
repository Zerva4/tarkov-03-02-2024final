<?php

namespace App\Repository\Item;

use App\Entity\Item\ItemPropertiesArmor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesArmor>
 *
 * @method ItemPropertiesArmor|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesArmor|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesArmor[]    findAll()
 * @method ItemPropertiesArmor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesArmorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesArmor::class);
    }

//    /**
//     * @return ItemPropertiesArmor[] Returns an array of ItemPropertiesArmor objects
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

//    public function findOneBySomeField($value): ?ItemPropertiesArmor
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
