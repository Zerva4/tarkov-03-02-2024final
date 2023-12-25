<?php

declare(strict_types=1);

namespace App\Repository\Item\Properties;

use App\Entity\Item\Properties\ItemPropertiesChestRig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesChestRig>
 *
 * @method ItemPropertiesChestRig|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesChestRig|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesChestRig[]    findAll()
 * @method ItemPropertiesChestRig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesChestRigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesChestRig::class);
    }

//    /**
//     * @return ItemPropertiesChestRig[] Returns an array of ItemPropertiesChestRig objects
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

//    public function findOneBySomeField($value): ?ItemPropertiesChestRig
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
