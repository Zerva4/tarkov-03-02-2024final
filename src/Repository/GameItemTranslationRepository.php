<?php

namespace App\Repository;

use App\Entity\GameItemTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GameItemTranslation>
 *
 * @method GameItemTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameItemTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameItemTranslation[]    findAll()
 * @method GameItemTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameItemTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameItemTranslation::class);
    }

    public function add(GameItemTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GameItemTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
