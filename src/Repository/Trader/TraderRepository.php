<?php

declare(strict_types=1);

namespace App\Repository\Trader;

use App\Entity\Trader\Trader;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Trader>
 *
 * @method Trader|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trader|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trader[]    findAll()
 * @method Trader[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TraderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trader::class);
    }

    public function add(Trader $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Trader $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllTraders(int $mode = AbstractQuery::HYDRATE_OBJECT)
    {
        return $this->createQueryBuilder('t')
            ->select('t.id, t.slug, t.imageName, t.resetTime, lang.shortName AS shortName, lang.fullName AS fullName')
            ->leftJoin('t.translations', 'lang')
            ->andWhere('t.published = true')
            ->addOrderBy('t.position', 'ASC')
            ->getQuery()
            ->getResult($mode)
        ;
    }

    public function findAllTradersWithCountCashOffer(int $mode = AbstractQuery::HYDRATE_OBJECT)
    {
        return $this->createQueryBuilder('t')
            ->select('t.id, t.slug, t.imageName, t.resetTime, lang.shortName AS shortName, lang.fullName AS fullName, count(t.cashOffers)')
            ->leftJoin('t.translations', 'lang')
            ->addSelect('count(t.cashOffers)')
            ->andWhere('t.published = true')
            ->addOrderBy('t.position', Criteria::ASC)
            ->getQuery()
            ->getResult($mode)
        ;
    }
}
