<?php

namespace App\Repository;

use App\Entity\Rank;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Rank|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rank|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rank[]    findAll()
 * @method Rank[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RankRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Rank::class);
    }

    // /**
    //  * @return Rank[] Returns an array of Rank objects
    //  */

    public function findBestPosition($keyword)
    {
        return $this->createQueryBuilder('r')
            ->where('r.position != 0')
            ->andWhere('r.keyword = :keyword')
            ->setParameter('keyword', $keyword)
            ->orderBy('r.position', 'ASC')
            ->setMaxResults(1)
            ->getQuery()->getOneOrNullResult();

    }

    public function findLatestPosition($keyword)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.keyword = :keyword')
            ->setParameter('keyword', $keyword)
            ->orderBy('r.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()->getOneOrNullResult();

    }

    /*
    public function findOneBySomeField($value): ?Rank
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
