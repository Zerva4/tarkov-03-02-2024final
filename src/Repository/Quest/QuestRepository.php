<?php

declare(strict_types=1);

namespace App\Repository\Quest;

use App\Entity\Quest\Quest;
use App\Entity\Quest\QuestTranslation;
use App\Entity\Trader\Trader;
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

    public function findQuestsByTraderId(UuidInterface $uuid, int $mode = AbstractQuery::HYDRATE_OBJECT): ?array
    {
        return $this->createQueryBuilder('q')
            ->select('l.id, l.title, l.description, l.howToComplete, q.imageName, q.position, q.slug')
            ->leftJoin('q.translations', 'l')
            ->andWhere('q.published = true')
            ->andWhere('q.trader = :trader')
            ->setParameter('trader', $uuid)
            ->addOrderBy('q.minPlayerLevel, q.position, l.title', 'ASC')
            ->getQuery()
            ->getResult($mode)
        ;
    }

    public function findQuestBySlug(string $slug, int $mode = AbstractQuery::HYDRATE_OBJECT): ?QuestInterface
    {
//        return $this->createQueryBuilder('q')
//            ->select('q.id, t.imageName AS traderImage, tt.fullName, tt.characterType, l.title, l.description, l.howToComplete, l.startDialog, l.successfulDialog, q.imageName, q.position, q.experience, q.minPlayerLevel')
//            ->leftJoin('q.translations', 'l')
//            ->leftJoin('q.trader', 't')
//            ->leftJoin('t.translations', 'tt')
//            ->andWhere('q.published = true')
//            ->andWhere('q.slug = :slug')
//            ->setParameter('slug', $slug)
//            ->getQuery()
//            ->getOneOrNullResult($mode)
//            ;
        return $this->findOneBy(['slug' => $slug]);
    }

    public function findTraderByQuestId(UuidInterface $uuid, int $mode = AbstractQuery::HYDRATE_OBJECT): array
    {
        return $this->createQueryBuilder('q')
            ->select('t.id, t.title')
            ->leftJoin('q.trader', 't')
            ->andWhere('q.id = :quest')
            ->setParameter('quest', $uuid)
            ->getQuery()
            ->getOneOrNullResult($mode);
    }
}
