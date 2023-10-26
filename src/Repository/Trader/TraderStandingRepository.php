<?php

namespace App\Repository\Trader;

use App\Entity\Trader\TraderStanding;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TraderStanding>
 *
 * @method TraderStanding|null find($id, $lockMode = null, $lockVersion = null)
 * @method TraderStanding|null findOneBy(array $criteria, array $orderBy = null)
 * @method TraderStanding[]    findAll()
 * @method TraderStanding[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TraderStandingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TraderStanding::class);
    }
}
