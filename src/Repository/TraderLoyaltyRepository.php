<?php

namespace App\Repository;

use App\Entity\TraderLoyalty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TraderLoyalty>
 *
 * @method TraderLoyalty|null find($id, $lockMode = null, $lockVersion = null)
 * @method TraderLoyalty|null findOneBy(array $criteria, array $orderBy = null)
 * @method TraderLoyalty[]    findAll()
 * @method TraderLoyalty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TraderLoyaltyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TraderLoyalty::class);
    }

    public function add(TraderLoyalty $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TraderLoyalty $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
