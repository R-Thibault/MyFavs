<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\FavCardsPrivate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\QueryBuilder as ORMQueryBuilder;

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
    private PaginatorInterface $paginator;
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
        {
            parent::__construct($registry, FavCardsPrivate::class);
            $this->paginator = $paginator;
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

        /**
     * @return FavCardsPrivate[] Returns an array of FavCardsPrivate objects
     */
    public function findSearch(SearchData $search, $user) : PaginationInterface
    {   

        $query = $this->getSearchQuery($search, $user)->getQuery();

        

        
        return $this->paginator->paginate(
            $query,
            $search->page,
            10
        );
    }

    private function getSearchQuery(SearchData $search, $user): ORMQueryBuilder
     {
        

        $query = $this
        ->createQueryBuilder('favCardsPrivate')
        ->andWhere('favCardsPrivate.Author = :val')
        ->setParameter('val', $user)
        ->select('tag', 'favCardsPrivate')
        ->join('favCardsPrivate.Tag', 'tag');

        if (!empty($search->searchText)) {
            $query = $query
                ->andWhere('favCardsPrivate.title LIKE :searchText')
                ->setParameter('searchText', "%{$search->searchText}%");
    
        }

        if (!empty($search->tags)) {
            $query = $query
                ->andWhere('tag.id IN (:tags)')
                ->setParameter('tags', $search->tags);
        }

        return $query;

     }
    

//    /**
//     * @return FavCardsPrivate[] Returns an array of FavCardsPrivate objects
//     */
//    public function findByAuthor($user): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.author = :val')
//            ->setParameter('val', $user)
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
