<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Trader;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Trader>
 *
 * @method Trader|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trader|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trader[]    findAll()
 * @method Trader[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TraderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trader::class);
    }

    public function add(Trader $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Trader $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
