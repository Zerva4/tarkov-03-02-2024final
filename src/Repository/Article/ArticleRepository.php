<?php

declare(strict_types=1);

namespace App\Repository\Article;

use App\Entity\Article\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function add(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findLastHomeArticles(int $maxItem = 3, int $mode = AbstractQuery::HYDRATE_OBJECT)
    {
        return $this->createQueryBuilder('a')
            ->select('a.id, a.slug,  a.createdAt, a.updatedAt, a.imagePoster, t.title AS title, t.description AS description')
            ->leftJoin('a.translations', 't')
//            ->andWhere('a.published = true')
            ->setFirstResult(0)
            ->setMaxResults($maxItem)
            ->getQuery()
            ->setResultCacheLifetime(0)
            ->getResult($mode)
        ;
    }

    public function getQueryArticlesByCategory(?string $slugCategory = null): Query
    {
        $dql = $this->createQueryBuilder('a')
            ->select('a.id, a.slug, a.createdAt, a.updatedAt, a.imagePoster, a.complexity, a.readingDuration, t.title AS title, t.description AS description, c.slug AS slugCategory')
            ->leftJoin('a.translations', 't')
            ->leftJoin('a.category', 'c')
            ->andWhere('a.status = :status')
            ->setParameters([
                'status' => Article::STATUS_PUBLISHED,
            ]);
        if (null !== $slugCategory) {
            $dql->andWhere('c.slug = :slugCategory')->setParameter('slugCategory', $slugCategory);
        }

        return $dql->getQuery();
    }

    public function findArticleBySlug(string $slugCategory, string $slugArticle, int $mode = AbstractQuery::HYDRATE_OBJECT): ?array
    {
        return $this->createQueryBuilder('a')
            ->select('a.id, a.slug, a.createdAt, a.updatedAt, a.imagePoster, a.complexity, a.readingDuration, t.title AS title, t.description AS description, t.body AS body, c.slug AS slugCategory')
            ->leftJoin('a.translations', 't')
            ->leftJoin('a.category', 'c')
            ->andWhere('a.status = :status')
            ->andWhere('a.slug = :slugArticle')
            ->andWhere('c.slug = :slugCategory')
            ->setParameters([
                'status' => Article::STATUS_PUBLISHED,
                'slugCategory' => $slugCategory,
                'slugArticle' => $slugArticle
            ])
            ->getQuery()
            ->getOneOrNullResult($mode)
        ;
    }
}
