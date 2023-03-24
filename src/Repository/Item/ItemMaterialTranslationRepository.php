<?php

namespace App\Repository\Item;

use App\Entity\Item\ItemMaterialTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemMaterialTranslation>
 *
 * @method ItemMaterialTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemMaterialTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemMaterialTranslation[]    findAll()
 * @method ItemMaterialTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemMaterialTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemMaterialTranslation::class);
    }

    public function save(ItemMaterialTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ItemMaterialTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
