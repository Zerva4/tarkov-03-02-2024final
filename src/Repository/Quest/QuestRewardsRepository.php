<?php

declare(strict_types=1);

namespace App\Repository\Quest;

use App\Entity\Quest\QuestRewards;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuestRewards>
 *
 * @method QuestRewards|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestRewards|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestRewards[]    findAll()
 * @method QuestRewards[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestRewardsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestRewards::class);
    }
}
