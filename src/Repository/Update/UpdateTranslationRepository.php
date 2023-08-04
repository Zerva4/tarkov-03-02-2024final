<?php

namespace App\Repository\Update;

use App\Entity\Update\UpdateTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UpdateTranslation>
 *
 * @method UpdateTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method UpdateTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method UpdateTranslation[]    findAll()
 * @method UpdateTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UpdateTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UpdateTranslation::class);
    }
}
