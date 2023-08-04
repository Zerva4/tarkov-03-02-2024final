<?php

namespace App\Repository\Workshop;

use App\Entity\Workshop\PlaceLevelTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlaceLevelTranslation>
 *
 * @method PlaceLevelTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlaceLevelTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlaceLevelTranslation[]    findAll()
 * @method PlaceLevelTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaceLevelTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlaceLevelTranslation::class);
    }

    public function add(PlaceLevelTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PlaceLevelTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
