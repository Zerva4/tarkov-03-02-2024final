<?php

namespace App\Repository\Trader;

use App\Entity\Trader\TraderCashOffer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TraderCashOffer>
 *
 * @method TraderCashOffer|null find($id, $lockMode = null, $lockVersion = null)
 * @method TraderCashOffer|null findOneBy(array $criteria, array $orderBy = null)
 * @method TraderCashOffer[]    findAll()
 * @method TraderCashOffer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TraderCashOfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TraderCashOffer::class);
    }

    public function save(TraderCashOffer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TraderCashOffer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TraderCashOffer[] Returns an array of TraderCashOffer objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TraderCashOffer
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
