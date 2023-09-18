<?php

declare(strict_types=1);

namespace App\Repository\Item;

use App\Entity\Item\ItemTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemTranslation>
 *
 * @method ItemTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemTranslation[]    findAll()
 * @method ItemTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemTranslation::class);
    }

    public function add(ItemTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ItemTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
