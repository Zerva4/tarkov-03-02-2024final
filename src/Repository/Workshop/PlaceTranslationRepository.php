<?php

namespace App\Repository\Workshop;

use App\Entity\Workshop\PlaceTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlaceTranslation>
 *
 * @method PlaceTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlaceTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlaceTranslation[]    findAll()
 * @method PlaceTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaceTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlaceTranslation::class);
    }

    public function add(PlaceTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PlaceTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
