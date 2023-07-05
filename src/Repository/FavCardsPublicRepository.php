<?php

namespace App\Repository;

use App\Entity\FavCardsPublic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FavCardsPublic>
 *
 * @method FavCardsPublic|null find($id, $lockMode = null, $lockVersion = null)
 * @method FavCardsPublic|null findOneBy(array $criteria, array $orderBy = null)
 * @method FavCardsPublic[]    findAll()
 * @method FavCardsPublic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavCardsPublicRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FavCardsPublic::class);
    }

    public function save(FavCardsPublic $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FavCardsPublic $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return FavCardsPublic[] Returns an array of FavCardsPublic objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FavCardsPublic
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
