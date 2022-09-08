<?php

namespace App\Repository;

use App\Entity\GameItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GameItem>
 *
 * @method GameItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameItem[]    findAll()
 * @method GameItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameItem::class);
    }

    public function add(GameItem $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GameItem $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
