<?php

declare(strict_types=1);

namespace App\Repository\Trader;

use App\Entity\Trader\TraderRequired;
use App\Interfaces\Trader\TraderRequiredInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\UuidInterface;

/**
 * @extends ServiceEntityRepository<TraderRequired>
 *
 * @method TraderRequired|null find($id, $lockMode = null, $lockVersion = null)
 * @method TraderRequired|null findOneBy(array $criteria, array $orderBy = null)
 * @method TraderRequired[]    findAll()
 * @method TraderRequired[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TraderRequiredRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TraderRequired::class);
    }

    public function save(TraderRequired $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TraderRequired $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByPlaceLevelRequiredByTraderId(?UuidInterface $placeLevelId, string $apiIdTrader): ?TraderRequiredInterface
    {
        return $this->createQueryBuilder('tr')
            ->leftJoin('tr.requiredForPlacesLevels', 'rpl')
            ->leftJoin('tr.trader', 'trt')
            ->andWhere('rpl.id = :id')
            ->andWhere('trt.apiId = :api_id')
            ->setParameters([
                'id' => $placeLevelId,
                'api_id' => $apiIdTrader
            ])
            ->getQuery()
            ->getOneOrNullResult();
    }
}
