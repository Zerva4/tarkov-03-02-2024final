<?php

namespace App\Repository\Item;

use App\Entity\Item\StimulationEffect;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StimulationEffect>
 *
 * @method StimulationEffect|null find($id, $lockMode = null, $lockVersion = null)
 * @method StimulationEffect|null findOneBy(array $criteria, array $orderBy = null)
 * @method StimulationEffect[]    findAll()
 * @method StimulationEffect[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StimulationEffectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StimulationEffect::class);
    }

//    /**
//     * @return StimEffect[] Returns an array of StimEffect objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StimEffect
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
