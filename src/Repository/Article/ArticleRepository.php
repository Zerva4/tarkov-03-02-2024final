<?php

declare(strict_types=1);

namespace App\Repository\Article;

use App\Entity\Article\Article;
use App\Entity\Article\ArticleCategory;
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

    public function findLastArticles(?string $locale = 'ru', int $maxItem = 3, int $type = ArticleCategory::TYPE_ARTICLE, int $mode = AbstractQuery::HYDRATE_OBJECT)
    {
        return $this->createQueryBuilder('a')
            ->select('a.id, a.slug,  a.createdAt, a.updatedAt, a.imagePoster, t.title AS title, t.description AS description, c.slug AS slugCategory')
            ->leftJoin('a.translations', 't')
            ->leftJoin('a.category', 'c')
            ->andWhere('t.locale = :locale')
            ->andWhere('a.status = :status')
            ->andWhere('c.type = :type')
            ->orderBy('a.createdAt', 'ASC')
            ->setParameters([
                'status' => Article::STATUS_PUBLISHED,
                'type' => $type,
                'locale' => $locale,
            ])
            ->setFirstResult($this->offset)
            ->setMaxResults($maxItem)
            ->getQuery()
            ->setResultCacheLifetime(0)
            ->getResult($mode)
        ;
    }

    public function getQueryArticlesByCategory(?string $locale = 'ru', ?string $slugCategory = null, int $type = ArticleCategory::TYPE_ARTICLE): Query
    {
        $dql = $this->createQueryBuilder('a')
            ->select('a.id, a.slug, a.createdAt, a.updatedAt, a.imagePoster, a.complexity, a.readingDuration, t.title AS title, t.description AS description, c.slug AS slugCategory')
            ->leftJoin('a.translations', 't')
            ->leftJoin('a.category', 'c')
            ->andWhere('t.locale = :locale')
            ->andWhere('a.status = :status')
            ->andWhere('c.type = :type')
            ->setParameters([
                'status' => Article::STATUS_PUBLISHED,
                'type' => $type,
                'locale' => $locale,
            ]);
        if (null !== $slugCategory) {
            $dql->andWhere('c.slug = :slugCategory')->setParameter('slugCategory', $slugCategory);
        }

        return $dql->getQuery();
    }

    public function getQueryNewsByCategory(?string $locale = 'ru', ?int $maxItem = 3, ?string $slugCategory = null, int $type = ArticleCategory::TYPE_ARTICLE): Query
    {
        $dql = $this->createQueryBuilder('a')
            ->select('a.id, a.slug, a.createdAt, a.updatedAt, a.imagePoster, a.complexity, a.readingDuration, t.title AS title, t.description AS description, t.body AS body, c.slug AS slugCategory')
            ->leftJoin('a.translations', 't')
            ->leftJoin('a.category', 'c')
            ->andWhere('t.locale = :locale')
            ->andWhere('a.status = :status')
            ->andWhere('c.type = :type')
            ->orderBy('a.createdAt', 'ASC')
            ->setParameters([
                'status' => Article::STATUS_PUBLISHED,
                'type' => $type,
                'locale' => $locale,
            ])
            ->setFirstResult(0)
            ->setMaxResults($maxItem)
        ;
        if (null !== $slugCategory) {
            $dql->andWhere('c.slug = :slugCategory')->setParameter('slugCategory', $slugCategory);
        }

        return $dql->getQuery();
    }

    public function findArticleBySlug(string $slugCategory, string $slugArticle, string $locale = 'ru', int $mode = AbstractQuery::HYDRATE_OBJECT): ?array
    {
        return $this->createQueryBuilder('a')
            ->select('a.id, a.slug, a.createdAt, a.updatedAt, a.imagePoster, a.complexity, a.readingDuration, t.title AS title, t.description AS description, t.body AS body, c.slug AS slugCategory')
            ->leftJoin('a.translations', 't')
            ->leftJoin('a.category', 'c')
            ->andWhere('a.status = :status')
            ->andWhere('a.slug = :slugArticle')
            ->andWhere('c.slug = :slugCategory')
            ->andWhere('t.locale = :locale')
            ->setParameters([
                'status' => Article::STATUS_PUBLISHED,
                'slugCategory' => $slugCategory,
                'slugArticle' => $slugArticle,
                'locale' => $locale
            ])
            ->getQuery()
            ->getOneOrNullResult($mode)
        ;
    }
}
