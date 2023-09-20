<?php

namespace App\Repository\Item;

use App\Entity\Item\ItemCaliber;
use App\Interfaces\Item\ItemCaliberInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemCaliber>
 *
 * @method ItemCaliber|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemCaliber|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemCaliber[]    findAll()
 * @method ItemCaliber[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemCaliberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemCaliber::class);
    }

//    /**
//     * @return ItemCaliber[] Returns an array of ItemCaliber objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ItemCaliber
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findByType(bool $isAmmo = true, string $orderBy = 'ASC'): ?array
    {
        return $this->createQueryBuilder('c')
            ->select('c.id, c.slug, lt.name')
            ->join('c.translations', 'lt', 'WITH', 'c.id = lt.translatable')
            ->andWhere('c.isAmmo = :isAmmo')
            ->setParameter('isAmmo', $isAmmo)
            ->orderBy('lt.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findByCaliber(string $caliber = 'Caliber556x45NATO', bool $isAmmo = true, string $orderBy = 'ASC'): ?ItemCaliberInterface
    {
        return $this->createQueryBuilder('c')
            ->select('c')
            ->andWhere('c.isAmmo = :isAmmo')
            ->andWhere('c.apiId = :caliber')
            ->setParameters([
                'isAmmo' => $isAmmo ? 'true' : 'false',
                'caliber' => $caliber,
            ])
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findBySlug(string $slug, bool $isAmmo = true, string $orderBy = 'ASC'): ?ItemCaliberInterface
    {
        return $this->createQueryBuilder('c')
            ->select('c')
            ->andWhere('c.isAmmo = :isAmmo')
            ->andWhere('c.slug = :slug')
            ->setParameters([
                'isAmmo' => $isAmmo ? 'true' : 'false',
                'slug' => $slug,
            ])
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}
