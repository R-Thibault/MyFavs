<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\FavCardsPublic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\QueryBuilder as ORMQueryBuilder;

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
    private PaginatorInterface $paginator;
public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, FavCardsPublic::class);
        $this->paginator = $paginator;
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

    /**
     * @return FavCardsPublic[] Returns an array of FavCardsPublic objects
     */
    public function findSearch(SearchData $search) : PaginationInterface
    {   

        $query = $this->getSearchQuery($search)->getQuery();

        

        
        return $this->paginator->paginate(
            $query,
            $search->page,
            12
        );
    }

    private function getSearchQuery(SearchData $search): ORMQueryBuilder
     {
        $query = $this
        ->createQueryBuilder('favCardsPublic')
        ->select('tag', 'favCardsPublic')
        ->join('favCardsPublic.Tag', 'tag');

        if (!empty($search->searchText)) {
            $query = $query
                ->andWhere('favCardsPublic.title LIKE :searchText')
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
