<?php

declare(strict_types=1);

namespace App\Repository\Item;

use App\Entity\Item\ItemPropertiesHeadphone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesHeadphone>
 *
 * @method ItemPropertiesHeadphone|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesHeadphone|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesHeadphone[]    findAll()
 * @method ItemPropertiesHeadphone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesHeadphoneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesHeadphone::class);
    }

//    /**
//     * @return ItemPropertiesHeadphone[] Returns an array of ItemPropertiesHeadphone objects
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

//    public function findOneBySomeField($value): ?ItemPropertiesHeadphone
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
