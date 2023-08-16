<?php

namespace App\Repository;

use App\Entity\Barter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Barter>
 *
 * @method Barter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Barter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Barter[]    findAll()
 * @method Barter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BarterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Barter::class);
    }

    public function save(Barter $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Barter $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
