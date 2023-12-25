<?php

declare(strict_types=1);

namespace App\Repository\Item\Properties;

use App\Entity\Item\Properties\ItemPropertiesAmmo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesAmmo>
 *
 * @method ItemPropertiesAmmo|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesAmmo|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesAmmo[]    findAll()
 * @method ItemPropertiesAmmo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesAmmoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesAmmo::class);
    }

//    /**
//     * @return ItemPropertiesAmmo[] Returns an array of ItemPropertiesAmmo objects
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

//    public function findOneBySomeField($value): ?ItemPropertiesAmmo
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
