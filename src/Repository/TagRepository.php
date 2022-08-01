<?php

namespace App\Repository;

use App\Entity\Tag;
use App\Interfaces\TagInterface;
use App\Interfaces\TagRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tag>
 *
 * @method Tag|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tag|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tag[]    findAll()
 * @method Tag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TagRepository extends ServiceEntityRepository implements TagRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tag::class);
    }

    public function add(Tag $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Tag $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findTagById(int $id): ?TagInterface
    {
        $qb = $this->createQueryBuilder('t')
            ->where('t.id = :id');

        $query = $qb->getQuery();
        $query->setParameter('id', $id);

        try {
            return $query->getOneOrNullResult(AbstractQuery::HYDRATE_OBJECT);
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    public function findTagByName($name): ?TagInterface
    {
        $qb = $this->createQueryBuilder('t')
            ->where('t.name = :name');

        $query = $qb->getQuery();
        $query->setParameter('name', $name);

        try {
            return $query->getOneOrNullResult(AbstractQuery::HYDRATE_OBJECT);
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    public function findAllTags(): array
    {
        return $this->findAll();
    }
}
