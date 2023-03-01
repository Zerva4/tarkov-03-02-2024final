<?php

namespace App\Repository;

use App\Entity\Items\ContainedItem;
use App\Interfaces\ContainedItemInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\UuidInterface;

/**
 * @extends ServiceEntityRepository<ContainedItem>
 *
 * @method ContainedItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContainedItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContainedItem[]    findAll()
 * @method ContainedItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContainedItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContainedItem::class);
    }

    public function save(ContainedItem $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ContainedItem $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findBarterRequiredItemByItemId(?UuidInterface $barterId, string $apiIdItem): ?ContainedItemInterface
    {
        return $this->createQueryBuilder('ci')
            ->leftJoin('ci.requiredInBarters', 'rib')
            ->leftJoin('ci.item', 'cii')
            ->andWhere('rib.id = :id')
            ->andWhere('cii.apiId = :api_id')
            ->setParameters([
                'id' => $barterId,
                'api_id' =>$apiIdItem
            ])
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findBarterRewardItemByItemId(?UuidInterface $barterId, string $apiIdItem): ?ContainedItemInterface
    {
        return $this->createQueryBuilder('ci')
            ->leftJoin('ci.rewardInBarters', 'rib')
            ->leftJoin('ci.item', 'cii')
            ->andWhere('rib.id = :id')
            ->andWhere('cii.apiId = :api_id')
            ->setParameters([
                'id' => $barterId,
                'api_id' =>$apiIdItem
            ])
            ->getQuery()
            ->getOneOrNullResult();
    }
}
