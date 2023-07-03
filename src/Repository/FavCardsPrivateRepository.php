<?php

namespace App\Repository;

use App\Entity\FavCardsPrivate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FavCardsPrivate>
 *
 * @method FavCardsPrivate|null find($id, $lockMode = null, $lockVersion = null)
 * @method FavCardsPrivate|null findOneBy(array $criteria, array $orderBy = null)
 * @method FavCardsPrivate[]    findAll()
 * @method FavCardsPrivate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavCardsPrivateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FavCardsPrivate::class);
    }

    public function save(FavCardsPrivate $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FavCardsPrivate $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return FavCardsPrivate[] Returns an array of FavCardsPrivate objects
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

//    public function findOneBySomeField($value): ?FavCardsPrivate
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
