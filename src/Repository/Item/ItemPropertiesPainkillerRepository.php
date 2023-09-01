<?php

declare(strict_types=1);

namespace App\Repository\Item;

use App\Entity\Item\ItemPropertiesPainkiller;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesPainkiller>
 *
 * @method ItemPropertiesPainkiller|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesPainkiller|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesPainkiller[]    findAll()
 * @method ItemPropertiesPainkiller[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesPainkillerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesPainkiller::class);
    }

//    /**
//     * @return ItemPropertiesPainkiller[] Returns an array of ItemPropertiesPainkiller objects
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

//    public function findOneBySomeField($value): ?ItemPropertiesPainkiller
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
