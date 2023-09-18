<?php

declare(strict_types=1);

namespace App\Repository\Item;

use App\Entity\Item\ItemMaterialTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemMaterialTranslation>
 *
 * @method ItemMaterialTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemMaterialTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemMaterialTranslation[]    findAll()
 * @method ItemMaterialTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemMaterialTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemMaterialTranslation::class);
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
