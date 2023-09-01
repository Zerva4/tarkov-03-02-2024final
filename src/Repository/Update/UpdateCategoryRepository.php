<?php

declare(strict_types=1);

namespace App\Repository\Update;

use App\Entity\Update\UpdateCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UpdateCategory>
 *
 * @method UpdateCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method UpdateCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method UpdateCategory[]    findAll()
 * @method UpdateCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UpdateCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UpdateCategory::class);
    }
}
