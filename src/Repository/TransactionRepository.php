<?php

namespace App\Repository;

use App\Entity\Transaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Transaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transaction[]    findAll()
 * @method Transaction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transaction::class);
    }
    public function countByAmountRange()
    {
        $qb = $this->createQueryBuilder('t');
        $qb->select('count(t.id)')
            ->where('t.amount >= 10')
            ->andWhere('t.amount <= 100');
    
        return $qb->getQuery()->getResult();
    }
    public function countByAmountRange2()
    {
        $qb = $this->createQueryBuilder('t');
        $qb->select('count(t.id)')
            ->where('t.amount >= 101')
            ->andWhere('t.amount <= 1000');
        

        return $qb->getQuery()->getResult();
    }
    public function countByAmountRange3()
    {
        $qb = $this->createQueryBuilder('t');
        $qb->select('count(t.id)')
            ->where('t.amount >= 1001');

        return $qb->getQuery()->getResult();
    }
   

}
