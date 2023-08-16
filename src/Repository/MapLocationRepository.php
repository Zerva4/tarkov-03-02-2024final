<?php

namespace App\Repository;

use App\Entity\MapLocation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MapLocation>
 *
 * @method MapLocation|null find($id, $lockMode = null, $lockVersion = null)
 * @method MapLocation|null findOneBy(array $criteria, array $orderBy = null)
 * @method MapLocation[]    findAll()
 * @method MapLocation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MapLocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MapLocation::class);
    }

    public function add(MapLocation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MapLocation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
