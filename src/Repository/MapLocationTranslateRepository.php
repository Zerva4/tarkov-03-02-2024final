<?php

namespace App\Repository;

use App\Entity\MapLocationTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MapLocationTranslation>
 *
 * @method MapLocationTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method MapLocationTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method MapLocationTranslation[]    findAll()
 * @method MapLocationTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MapLocationTranslateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MapLocationTranslation::class);
    }

    public function add(MapLocationTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MapLocationTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MapLocationTranslate[] Returns an array of MapLocationTranslate objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MapLocationTranslate
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
