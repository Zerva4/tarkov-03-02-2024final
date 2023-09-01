<?php

declare(strict_types=1);

namespace App\Repository\Item;

use App\Entity\Item\ItemMaterial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemMaterial>
 *
 * @method ItemMaterial|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemMaterial|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemMaterial[]    findAll()
 * @method ItemMaterial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemMaterialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemMaterial::class);
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
