<?php

namespace App\Repository\Quest;

use App\Entity\Quest\QuestAdvice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuestAdvice>
 *
 * @method QuestAdvice|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestAdvice|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestAdvice[]    findAll()
 * @method QuestAdvice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestAdviceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestAdvice::class);
    }

//    /**
//     * @return QuestAdvice[] Returns an array of QuestAdvice objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('q.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?QuestAdvice
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
