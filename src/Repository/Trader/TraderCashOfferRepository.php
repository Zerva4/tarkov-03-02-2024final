<?php

namespace App\Repository\Trader;

use App\Entity\Trader\TraderCashOffer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TraderCashOffer>
 *
 * @method TraderCashOffer|null find($id, $lockMode = null, $lockVersion = null)
 * @method TraderCashOffer|null findOneBy(array $criteria, array $orderBy = null)
 * @method TraderCashOffer[]    findAll()
 * @method TraderCashOffer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TraderCashOfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TraderCashOffer::class);
    }

    public function save(TraderCashOffer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TraderCashOffer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
