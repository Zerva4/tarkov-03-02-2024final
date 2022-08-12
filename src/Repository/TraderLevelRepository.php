<?php

namespace App\Repository;

use App\Entity\TraderLevel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TraderLevel>
 *
 * @method TraderLevel|null find($id, $lockMode = null, $lockVersion = null)
 * @method TraderLevel|null findOneBy(array $criteria, array $orderBy = null)
 * @method TraderLevel[]    findAll()
 * @method TraderLevel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TraderLoyaltyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TraderLevel::class);
    }

    public function add(TraderLevel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TraderLevel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
