<?php

namespace App\Repository\Item;

use App\Entity\Item\ArmorMaterial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ArmorMaterial>
 *
 * @method ArmorMaterial|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArmorMaterial|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArmorMaterial[]    findAll()
 * @method ArmorMaterial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArmorMaterialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArmorMaterial::class);
    }

//    /**
//     * @return ArmorMaterial[] Returns an array of ArmorMaterial objects
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

//    public function findOneBySomeField($value): ?ArmorMaterial
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
