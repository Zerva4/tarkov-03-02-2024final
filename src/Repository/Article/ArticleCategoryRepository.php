<?php

namespace App\Repository\Article;

use App\Entity\Article\ArticleCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ArticleCategory>
 *
 * @method ArticleCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleCategory[]    findAll()
 * @method ArticleCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleCategory::class);
    }

    public function findAllCategory(string $locale, int $mode = AbstractQuery::HYDRATE_ARRAY): ?array
    {
        return $this->createQueryBuilder('c')
            ->select('c.id, c.slug, t.name AS name')
            ->leftJoin('c.translations', 't')
            ->andWhere('c.published = true')
            ->andWhere('t.locale = :locale')
            ->orderBy('t.name', 'ASC')
            ->setParameter('locale', $locale)
            ->getQuery()
            ->setResultCacheLifetime(0)
            ->getResult($mode)
        ;
    }
}
