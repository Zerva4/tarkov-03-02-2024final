<?php

namespace App\Repository\Trader;

use App\Entity\Trader\TraderLevel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\UuidInterface;

/**
 * @extends ServiceEntityRepository<TraderLevel>
 *
 * @method TraderLevel|null find($id, $lockMode = null, $lockVersion = null)
 * @method TraderLevel|null findOneBy(array $criteria, array $orderBy = null)
 * @method TraderLevel[]    findAll()
 * @method TraderLevel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TraderLevelRepository extends ServiceEntityRepository
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

    public function findLevelsByTraderId(UuidInterface $uuid, int $mode = AbstractQuery::HYDRATE_OBJECT): ?array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.trader = :trader')
            ->setParameter('trader', $uuid)
            ->getQuery()
            ->getResult($mode)
            ;
    }
}
