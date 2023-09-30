<?php

declare(strict_types=1);

namespace App\Repository\Quest;

use App\Entity\Quest\Quest;
use App\Interfaces\Quest\QuestInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\UuidInterface;

/**
 * @extends ServiceEntityRepository<Quest>
 *
 * @method Quest|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quest|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quest[]    findAll()
 * @method Quest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quest::class);
    }

    public function add(Quest $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Quest $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findQuestsByTraderId(UuidInterface $uuid, string $locale, int $mode = AbstractQuery::HYDRATE_OBJECT): ?array
    {
        return $this->createQueryBuilder('q')
            ->select('l.id, l.name, l.description, l.howToComplete, q.imageName, q.position, q.slug')
            ->leftJoin('q.translations', 'l')
            ->andWhere('q.published = true')
            ->andWhere('q.trader = :trader')
            ->andWhere('l.locale = :locale')
            ->setParameter('trader', $uuid)
            ->setParameter('locale', $locale)
            ->addOrderBy('q.minPlayerLevel, q.position', 'ASC')
            ->getQuery()
            ->getResult($mode)
        ;
    }

    public function findQuestBySlug(string $slug, string $locale, int $mode = AbstractQuery::HYDRATE_OBJECT): ?QuestInterface
    {
//        return $this->createQueryBuilder('q')
//            ->select('q.id, t.imageName AS traderImage, tt.fullName, tt.shortName, q.objectives AS objectives, l.name, l.description, l.howToComplete, l.startDialog, l.successfulDialog, q.imageName, q.position, q.experience, q.minPlayerLevel')
//            ->leftJoin('q.translations', 'l')
//            ->leftJoin('q.trader', 't')
//            ->leftJoin('t.translations', 'tt')
//            ->leftJoin('q.objectives', 'o')
//            ->andWhere('q.published = true')
//            ->andWhere('q.slug = :slug')
//            ->andWhere('l.locale = :locale')
//            ->andWhere('tt.locale = :locale')
//            ->setParameters([
//                'slug' => $slug,
//                'locale' => $locale
//            ])
//            ->getQuery()
//            ->getResult($mode)
//        ;
        return $this->findOneBy([
            'slug' => $slug,
        ]);
    }

    public function findTraderByQuestId(UuidInterface $uuid, int $mode = AbstractQuery::HYDRATE_OBJECT): array
    {
        return $this->createQueryBuilder('q')
            ->select('t.id, t.name')
            ->leftJoin('q.trader', 't')
            ->andWhere('q.id = :quest')
            ->setParameter('quest', $uuid)
            ->getQuery()
            ->getOneOrNullResult($mode);
    }
}
