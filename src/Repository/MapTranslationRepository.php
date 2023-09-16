<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\MapTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MapTranslation>
 *
 * @method MapTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method MapTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method MapTranslation[]    findAll()
 * @method MapTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MapTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MapTranslation::class);
    }

    public function add(MapTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MapTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
