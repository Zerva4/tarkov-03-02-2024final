<?php

declare(strict_types=1);

namespace App\Repository\Item;

use App\Entity\Item\ItemPropertiesGlasses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesGlasses>
 *
 * @method ItemPropertiesGlasses|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesGlasses|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesGlasses[]    findAll()
 * @method ItemPropertiesGlasses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesGlassesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesGlasses::class);
    }

//    /**
//     * @return ItemPropertiesGlasses[] Returns an array of ItemPropertiesGlasses objects
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

//    public function findOneBySomeField($value): ?ItemPropertiesGlasses
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
