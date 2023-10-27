<?php

declare(strict_types=1);

namespace App\Repository\Item;

use App\Entity\Item\ContainedItem;
use App\Interfaces\Item\ContainedItemInterface;
use App\Interfaces\Item\ItemInterface;
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

    public function findCraftRewardItemByItemId(?UuidInterface $craftId, string $apiIdItem): ?ContainedItemInterface
    {
        return $this->createQueryBuilder('ci')
            ->leftJoin('ci.rewardInCrafts', 'rib')
            ->leftJoin('ci.item', 'cii')
            ->andWhere('rib.id = :id')
            ->andWhere('cii.apiId = :api_id')
            ->setParameters([
                'id' => $craftId,
                'api_id' =>$apiIdItem
            ])
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findCraftRequiredItemByItemId(?UuidInterface $craftId, string $apiIdItem): ?ContainedItemInterface
    {
        return $this->createQueryBuilder('ci')
            ->leftJoin('ci.requiredInCrafts', 'rib')
            ->leftJoin('ci.item', 'cii')
            ->andWhere('rib.id = :id')
            ->andWhere('cii.apiId = :api_id')
            ->setParameters([
                'id' => $craftId,
                'api_id' =>$apiIdItem
            ])
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findPlaceLevelRequiredForByItemId(?UuidInterface $placeLevelId, string $apiIdItem): ?ContainedItemInterface
    {
        return $this->createQueryBuilder('ci')
            ->leftJoin('ci.requiredForPlacesLevels', 'rpl')
            ->leftJoin('ci.item', 'cii')
            ->andWhere('rpl.id = :id')
            ->andWhere('cii.apiId = :api_id')
            ->setParameters([
                'id' => $placeLevelId,
                'api_id' =>$apiIdItem
            ])
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findQuestUsedItemByItemId(?UuidInterface $questId, string $apiIdItem): ?ContainedItemInterface
    {
        return $this->createQueryBuilder('ci')
            ->leftJoin('ci.usedInQuests', 'uiq')
            ->leftJoin('ci.item', 'cii')
            ->andWhere('uiq.id = :id')
            ->andWhere('cii.apiId = :api_id')
            ->setParameters([
                'id' => $questId,
                'api_id' =>$apiIdItem
            ])
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findQuestUsedItems(?UuidInterface $questId): mixed
    {
        return $this->createQueryBuilder('ci')
            ->leftJoin('ci.usedInQuests', 'uiq')
            ->leftJoin('ci.item', 'cii')
            ->andWhere('uiq.id = :id')
            ->setParameters([
                'id' => $questId,
            ])
            ->getQuery()
            ->getResult();
    }

    public function findReceivedItemByQuestAndItemId(?UuidInterface $questId, string $apiIdItem): ?ContainedItemInterface
    {
        return $this->createQueryBuilder('ci')
            ->leftJoin('ci.receivedFromQuests', 'riq')
            ->leftJoin('ci.item', 'cii')
            ->andWhere('riq.id = :id')
            ->andWhere('cii.apiId = :api_id')
            ->setParameters([
                'id' => $questId,
                'api_id' =>$apiIdItem
            ])
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findUsedInQuest(ItemInterface $item): ?array
    {
        $containedItems = $this->createQueryBuilder('ci')
            ->leftJoin('ci.item', 'cii')
            ->leftJoin('ci.usedInQuests', 'q')
            ->andWhere('cii.id = :id')
            ->setParameters([
                'id' => $item->getId(),
            ])
            ->getQuery()
            ->getResult()
        ;

        $usedInQuest = null;
        if ($containedItems) {
            /** @var ContainedItemInterface $containedItem */
            foreach ($containedItems as $containedItem) {
                $quests = $containedItem->getUsedInQuests();
                foreach ($quests as $quest) {
                    $questItem['count'] = $containedItem->getCount();
                    $questItem['quest'] = $quest;
                    $usedInQuest['quests'][] = $questItem;
                }
            }
        }

        return $usedInQuest;
    }

    public function findReceivedFromQuest(ItemInterface $item): ?array
    {
        $containedItems = $this->createQueryBuilder('ci')
            ->leftJoin('ci.item', 'cii')
            ->leftJoin('ci.receivedFromQuests', 'q')
            ->andWhere('cii.id = :id')
            ->setParameters([
                'id' => $item->getId(),
            ])
            ->getQuery()
            ->getResult()
        ;

        $receivedFromQuest = null;
        if ($containedItems) {
            /** @var ContainedItemInterface $containedItem */
            foreach ($containedItems as $containedItem) {
                $quests = $containedItem->getReceivedFromQuests();
                foreach ($quests as $quest) {
                    $questItem['count'] = $containedItem->getCount();
                    $questItem['quest'] = $quest;
                    $receivedFromQuest[] = $questItem;
                }
            }
        }

        return $receivedFromQuest;
    }
}
