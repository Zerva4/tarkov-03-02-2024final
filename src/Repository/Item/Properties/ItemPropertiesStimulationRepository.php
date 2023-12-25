<?php

namespace App\Repository\Item\Properties;

use App\Entity\Item\Properties\ItemPropertiesStimulation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesStimulation>
 *
 * @method ItemPropertiesStimulation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesStimulation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesStimulation[]    findAll()
 * @method ItemPropertiesStimulation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesStimulationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesStimulation::class);
    }
}
