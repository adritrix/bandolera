<?php

namespace App\Repository;

use App\Entity\Regist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Regist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Regist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Regist[]    findAll()
 * @method Regist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Regist::class);
    }

    // /**
    //  * @return Regist[] Returns an array of Regist objects
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
    public function findOneBySomeField($value): ?Regist
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
