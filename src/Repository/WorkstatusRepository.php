<?php

namespace App\Repository;

use App\Entity\Workstatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Workstatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method Workstatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method Workstatus[]    findAll()
 * @method Workstatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkstatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Workstatus::class);
    }

    // /**
    //  * @return Workstatus[] Returns an array of Workstatus objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Workstatus
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
