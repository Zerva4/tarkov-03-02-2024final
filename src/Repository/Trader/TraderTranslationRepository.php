<?php

namespace App\Repository\Trader;

use App\Entity\Trader\TraderTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TraderTranslation>
 *
 * @method TraderTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method TraderTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method TraderTranslation[]    findAll()
 * @method TraderTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TraderTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TraderTranslation::class);
    }

    public function add(TraderTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TraderTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
