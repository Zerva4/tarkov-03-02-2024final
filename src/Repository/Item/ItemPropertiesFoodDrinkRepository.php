<?php

declare(strict_types=1);

namespace App\Repository\Item;

use App\Entity\Item\Properties\ItemPropertiesFoodDrink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesFoodDrink>
 *
 * @method ItemPropertiesFoodDrink|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesFoodDrink|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesFoodDrink[]    findAll()
 * @method ItemPropertiesFoodDrink[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesFoodDrinkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesFoodDrink::class);
    }

//    /**
//     * @return ItemPropertiesFoodDrink[] Returns an array of ItemPropertiesFoodDrink objects
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

//    public function findOneBySomeField($value): ?ItemPropertiesFoodDrink
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
