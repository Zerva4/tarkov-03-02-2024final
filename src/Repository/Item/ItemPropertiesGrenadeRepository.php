<?php

namespace App\Repository\Item;

use App\Entity\Item\ItemPropertiesGrenade;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesGrenade>
 *
 * @method ItemPropertiesGrenade|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesGrenade|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesGrenade[]    findAll()
 * @method ItemPropertiesGrenade[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesGrenadeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesGrenade::class);
    }

//    /**
//     * @return ItemPropertiesGrenade[] Returns an array of ItemPropertiesGrenade objects
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

//    public function findOneBySomeField($value): ?ItemPropertiesGrenade
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
