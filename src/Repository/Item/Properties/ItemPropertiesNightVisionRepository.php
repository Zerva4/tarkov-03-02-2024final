<?php

declare(strict_types=1);

namespace App\Repository\Item\Properties;

use App\Entity\Item\Properties\ItemPropertiesNightVision;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesNightVision>
 *
 * @method ItemPropertiesNightVision|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesNightVision|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesNightVision[]    findAll()
 * @method ItemPropertiesNightVision[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesNightVisionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesNightVision::class);
    }

//    /**
//     * @return ItemPropertiesNightVision[] Returns an array of ItemPropertiesNightVision objects
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

//    public function findOneBySomeField($value): ?ItemPropertiesNightVision
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
