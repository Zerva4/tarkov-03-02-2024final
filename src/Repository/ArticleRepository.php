<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
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
}
