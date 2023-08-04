<?php

namespace App\Repository\Workshop;

use App\Entity\Workshop\PlaceLevelRequired;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlaceLevelRequired>
 *
 * @method PlaceLevelRequired|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlaceLevelRequired|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlaceLevelRequired[]    findAll()
 * @method PlaceLevelRequired[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaceLevelRequiredRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlaceLevelRequired::class);
    }

    public function save(PlaceLevelRequired $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PlaceLevelRequired $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
