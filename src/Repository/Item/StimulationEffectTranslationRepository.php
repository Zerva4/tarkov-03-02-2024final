<?php

namespace App\Repository\Item;

use App\Entity\Item\StimulationEffectTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StimulationEffectTranslation>
 *
 * @method StimulationEffectTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method StimulationEffectTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method StimulationEffectTranslation[]    findAll()
 * @method StimulationEffectTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StimulationEffectTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StimulationEffectTranslation::class);
    }

//    /**
//     * @return StimulationEffectTranslation[] Returns an array of StimulationEffectTranslation objects
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

//    public function findOneBySomeField($value): ?StimulationEffectTranslation
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
