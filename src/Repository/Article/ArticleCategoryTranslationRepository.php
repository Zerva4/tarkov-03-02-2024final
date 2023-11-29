<?php

namespace App\Repository\Article;

use App\Entity\Article\ArticleCategoryTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ArticleCategoryTranslation>
 *
 * @method ArticleCategoryTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleCategoryTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleCategoryTranslation[]    findAll()
 * @method ArticleCategoryTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleCategoryTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleCategoryTranslation::class);
    }

//    /**
//     * @return ArticleCategoryTranslation[] Returns an array of ArticleCategoryTranslation objects
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

//    public function findOneBySomeField($value): ?ArticleCategoryTranslation
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
