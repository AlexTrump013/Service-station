<?php

namespace App\Repository;

use App\Entity\Carinfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Carinfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Carinfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Carinfo[]    findAll()
 * @method Carinfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarinfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Carinfo::class);
    }

    // /**
    //  * @return Carinfo[] Returns an array of Carinfo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Carinfo
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
