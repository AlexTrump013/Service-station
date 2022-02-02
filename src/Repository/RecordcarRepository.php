<?php

namespace App\Repository;

use App\Entity\Recordcar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Recordcar|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recordcar|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recordcar[]    findAll()
 * @method Recordcar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecordcarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recordcar::class);
    }

    // /**
    //  * @return Recordcar[] Returns an array of Recordcar objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recordcar
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
