<?php

namespace App\Repository\Quest;

use App\Entity\Quest\QuestItemTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuestItemTranslation>
 *
 * @method QuestItemTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestItemTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestItemTranslation[]    findAll()
 * @method QuestItemTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestItemTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestItemTranslation::class);
    }

    public function add(QuestItemTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(QuestItemTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
