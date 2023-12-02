<?php

namespace App\Repository\Item\Properties;

use App\Entity\Item\Properties\ItemPropertiesPreset;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesPreset>
 *
 * @method ItemPropertiesPreset|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesPreset|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesPreset[]    findAll()
 * @method ItemPropertiesPreset[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesPresetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesPreset::class);
    }
}
