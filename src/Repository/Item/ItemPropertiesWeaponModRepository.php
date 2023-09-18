<?php

declare(strict_types=1);

namespace App\Repository\Item;

use App\Entity\Item\ItemPropertiesWeaponMod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesWeaponMod>
 *
 * @method ItemPropertiesWeaponMod|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesWeaponMod|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesWeaponMod[]    findAll()
 * @method ItemPropertiesWeaponMod[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesWeaponModRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesWeaponMod::class);
    }

//    /**
//     * @return ItemPropertiesWeaponMod[] Returns an array of ItemPropertiesWeaponMod objects
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

//    public function findOneBySomeField($value): ?ItemPropertiesWeaponMod
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
