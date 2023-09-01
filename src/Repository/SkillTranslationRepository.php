<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\SkillTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SkillTranslation>
 *
 * @method SkillTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method SkillTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method SkillTranslation[]    findAll()
 * @method SkillTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SkillTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SkillTranslation::class);
    }

    public function add(SkillTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SkillTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
