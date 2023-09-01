<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\BossHealth;
use App\Interfaces\BossHealthInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\UuidInterface;

/**
 * @extends ServiceEntityRepository<BossHealth>
 *
 * @method BossHealth|null find($id, $lockMode = null, $lockVersion = null)
 * @method BossHealth|null findOneBy(array $criteria, array $orderBy = null)
 * @method BossHealth[]    findAll()
 * @method BossHealth[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BossHealthRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BossHealth::class);
    }

    public function save(BossHealth $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BossHealth $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findByByNameAndBossId(UuidInterface $bossId, string $name): ?BossHealthInterface
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.boss = :bossId')
            ->andWhere('h.name = :name')
            ->setParameters([
                'bossId' => $bossId,
                'name' => $name
            ])
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

//    /**
//     * @return BossHealt[] Returns an array of BossHealt objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BossHealt
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
