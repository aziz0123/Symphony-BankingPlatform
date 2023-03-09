<?php

namespace App\Repository;

use App\Entity\CarteBancaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarteBancaire>
 *
 * @method CarteBancaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteBancaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteBancaire[]    findAll()
 * @method CarteBancaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteBancaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarteBancaire::class);
    }

    public function add(CarteBancaire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CarteBancaire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function getAllRibs(): array
    {
        return $this->createQueryBuilder('a')
            ->select('a.rib')
            ->getQuery()
            ->getResult();
    }


//    /**
//     * @return Compte[] Returns an array of Compte objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Compte
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function countByType1()
{
    $qb = $this->createQueryBuilder('t');
    $qb->select('count(t.id)')
        ->where('t.idType = 6');

    return $qb->getQuery()->getResult();
}
public function countByType2()
{
    $qb = $this->createQueryBuilder('t');
    $qb->select('count(t.id)')
        ->where('t.idType = 7');

    return $qb->getQuery()->getResult();
}
public function countByType3()
{
    $qb = $this->createQueryBuilder('t');
    $qb->select('count(t.id)')
        ->where('t.idType = 8');

    return $qb->getQuery()->getResult();
}
}
