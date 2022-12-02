<?php

namespace App\Repository;

use App\Entity\ItemMaterial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemMaterial>
 *
 * @method ItemMaterial|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemMaterial|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemMaterial[]    findAll()
 * @method ItemMaterial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemMaterialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemMaterial::class);
    }

    public function save(ItemMaterial $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ItemMaterial $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
