<?php

namespace App\Repository\Item;

use App\Entity\Item\ItemCaliberTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemCaliberTranslation>
 *
 * @method ItemCaliberTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemCaliberTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemCaliberTranslation[]    findAll()
 * @method ItemCaliberTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemCaliberTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemCaliberTranslation::class);
    }

//    /**
//     * @return ItemCaliberTranslation[] Returns an array of ItemCaliberTranslation objects
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

//    public function findOneBySomeField($value): ?ItemCaliberTranslation
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
