<?php

namespace App\Repository;

use App\Entity\Favories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Favories|null find($id, $lockMode = null, $lockVersion = null)
 * @method Favories|null findOneBy(array $criteria, array $orderBy = null)
 * @method Favories[]    findAll()
 * @method Favories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Favories::class);
    }

    // /**
    //  * @return Favories[] Returns an array of Favories objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Favories
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
