<?php

namespace App\Repository\Item;

use App\Entity\Item\ItemPropertiesWeapon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesWeapon>
 *
 * @method ItemPropertiesWeapon|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesWeapon|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesWeapon[]    findAll()
 * @method ItemPropertiesWeapon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesWeaponRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesWeapon::class);
    }

//    /**
//     * @return ItemPropertiesWeapon[] Returns an array of ItemPropertiesWeapon objects
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

//    public function findOneBySomeField($value): ?ItemPropertiesWeapon
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
