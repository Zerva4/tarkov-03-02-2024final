<?php

declare(strict_types=1);

namespace App\Repository\Quest;

use App\Entity\Quest\QuestTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuestTranslation>
 *
 * @method QuestTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestTranslation[]    findAll()
 * @method QuestTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestTranslation::class);
    }

    public function add(QuestTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(QuestTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
