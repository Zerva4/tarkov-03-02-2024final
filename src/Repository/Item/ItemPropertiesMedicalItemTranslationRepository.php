<?php

namespace App\Repository\Item;

use App\Entity\Item\ItemPropertiesMedicalItemTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesMedicalItemTranslation>
 *
 * @method ItemPropertiesMedicalItemTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesMedicalItemTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesMedicalItemTranslation[]    findAll()
 * @method ItemPropertiesMedicalItemTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesMedicalItemTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesMedicalItemTranslation::class);
    }

//    /**
//     * @return ItemPropertiesMedicalItemTranslation[] Returns an array of ItemPropertiesMedicalItemTranslation objects
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

//    public function findOneBySomeField($value): ?ItemPropertiesMedicalItemTranslation
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
