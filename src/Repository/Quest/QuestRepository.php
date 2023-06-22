<?php

declare(strict_types=1);

namespace App\Repository\Quest;

use App\Entity\Quest\Quest;
use App\Entity\Quest\QuestTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\UuidInterface;

/**
 * @extends ServiceEntityRepository<Quest>
 *
 * @method Quest|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quest|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quest[]    findAll()
 * @method Quest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quest::class);
    }

    public function add(Quest $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Quest $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findQuestsByTraderId(UuidInterface $uuid, int $mode = AbstractQuery::HYDRATE_OBJECT): ?array
    {
        return $this->createQueryBuilder('q')
            ->select('t.id, t.title, t.description, t.howToComplete, q.imageName, q.position, q.slug')
            ->leftJoin('q.translations', 't')
            ->andWhere('q.published = true')
            ->andWhere('q.trader = :trader')
            ->setParameter('trader', $uuid)
            ->addOrderBy('q.position, t.title', 'ASC')
            ->getQuery()
            ->getResult($mode)
        ;
    }
}
