<?php

namespace App\Repository\Item;

use App\Entity\Item\ArmorMaterialTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ArmorMaterialTranslation>
 *
 * @method ArmorMaterialTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArmorMaterialTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArmorMaterialTranslation[]    findAll()
 * @method ArmorMaterialTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemMaterialTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArmorMaterialTranslation::class);
    }

//    /**
//     * @return ArmorMaterialTranslation[] Returns an array of ArmorMaterialTranslation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ArmorMaterialTranslation
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
