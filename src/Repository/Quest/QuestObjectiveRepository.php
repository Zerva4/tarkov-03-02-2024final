<?php

namespace App\Repository\Quest;

use App\Entity\Quest\QuestObjective;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\UuidInterface;

/**
 * @extends ServiceEntityRepository<QuestObjective>
 *
 * @method QuestObjective|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestObjective|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestObjective[]    findAll()
 * @method QuestObjective[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestObjectiveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestObjective::class);
    }

    public function add(QuestObjective $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(QuestObjective $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findObjectivesByQuestId(UuidInterface $uuid, int $mode = AbstractQuery::HYDRATE_OBJECT): array
    {
        return $this->createQueryBuilder('o')
            ->select('t.description, o.optional')
            ->leftJoin('o.translations', 't')
            ->andWhere('o.quest = :quest')
            ->setParameter('quest', $uuid)
            ->getQuery()
            ->getResult($mode)
        ;
    }
}
