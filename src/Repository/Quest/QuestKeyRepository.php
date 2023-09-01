<?php

declare(strict_types=1);

namespace App\Repository\Quest;

use App\Entity\Quest\QuestKey;
use App\Interfaces\Quest\QuestKeyInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\UuidInterface;

/**
 * @extends ServiceEntityRepository<QuestKey>
 *
 * @method QuestKey|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestKey|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestKey[]    findAll()
 * @method QuestKey[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestKeyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestKey::class);
    }

    public function save(QuestKey $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(QuestKey $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByQuestAndItemIds(?UuidInterface $questId, string $apiIdItem): ?QuestKeyInterface
    {
        return $this->createQueryBuilder('qk')
            ->leftJoin('qk.quest', 'qkq')
            ->leftJoin('qk.item', 'qki')
            ->andWhere('qkq.id = :id')
            ->andWhere('qki.apiId = :api_id')
            ->setParameters([
                'id' => $questId,
                'api_id' =>$apiIdItem
            ])
            ->getQuery()
            ->getOneOrNullResult();
    }
}
