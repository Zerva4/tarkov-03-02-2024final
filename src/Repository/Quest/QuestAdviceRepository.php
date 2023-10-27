<?php

namespace App\Repository\Quest;

use App\Entity\Quest\QuestAdvice;
use App\Interfaces\Item\ItemInterface;
use App\Interfaces\Quest\QuestAdviceInterface;
use App\Interfaces\Quest\QuestInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
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

    public function findRandomAdvice(QuestInterface $quest, int $mode = AbstractQuery::HYDRATE_OBJECT): ?QuestAdviceInterface
    {
        $count = $this->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return $this->createQueryBuilder('qa')
            ->andWhere('qa.published = true')
//            ->andWhere('qa.quests IN :questId')
//            ->setParameter('questId', $quest->getId())
            ->setFirstResult(rand(0, $count - 1))
            ->setMaxResults(1)
//            ->setFirstResult($rndOffset)
            ->getQuery()
            ->getSingleResult()
        ;
    }
}
