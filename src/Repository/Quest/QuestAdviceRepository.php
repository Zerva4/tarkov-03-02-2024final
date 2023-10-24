<?php

namespace App\Repository\Quest;

use App\Entity\Quest\QuestAdvice;
use App\Interfaces\Item\ItemInterface;
use App\Interfaces\Quest\QuestAdviceInterface;
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

    public function findRandomAdvice(int $mode = AbstractQuery::HYDRATE_OBJECT): ?QuestAdviceInterface
    {
        $count = $this->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $rndOffset = rand(0, $count);

        $query = $this->createQueryBuilder('qa')
            ->setMaxResults($rndOffset)
            ->setFirstResult($rndOffset)
            ->getQuery()
        ;
        $result = $query->getResult();

        return $result[0];
    }
}
