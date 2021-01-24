<?php

namespace App\Repository;

use App\Entity\AnalysisResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AnalysisResult|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnalysisResult|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnalysisResult[]    findAll()
 * @method AnalysisResult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnalysisResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnalysisResult::class);
    }

    // /**
    //  * @return AnalysisResult[] Returns an array of AnalysisResult objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AnalysisResult
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
