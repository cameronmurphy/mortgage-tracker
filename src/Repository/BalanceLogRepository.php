<?php

namespace App\Repository;

use App\Entity\BalanceLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BalanceLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method BalanceLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method BalanceLog[]    findAll()
 * @method BalanceLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BalanceLogRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BalanceLog::class);
    }

    // /**
    //  * @return BalanceLog[] Returns an array of BalanceLog objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BalanceLog
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
