<?php

namespace App\Repository\Item\Properties;

use App\Entity\Item\Properties\ItemPropertiesStimulationEffect;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemPropertiesStimulationEffect>
 *
 * @method ItemPropertiesStimulationEffect|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPropertiesStimulationEffect|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPropertiesStimulationEffect[]    findAll()
 * @method ItemPropertiesStimulationEffect[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPropertiesStimulationEffectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPropertiesStimulationEffect::class);
    }
}
