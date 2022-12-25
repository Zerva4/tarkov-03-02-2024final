<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Map;
use App\Entity\Quests\QuestObjectiveTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuestObjectiveTranslation>
 *
 * @method QuestObjectiveTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestObjectiveTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestObjectiveTranslation[]    findAll()
 * @method QuestObjectiveTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestObjectiveTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Map::class);
    }

    public function add(Map $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Map $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
