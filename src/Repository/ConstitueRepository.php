<?php

namespace App\Repository;

use App\Entity\Constitue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Constitue>
 *
 * @method Constitue|null find($id, $lockMode = null, $lockVersion = null)
 * @method Constitue|null findOneBy(array $criteria, array $orderBy = null)
 * @method Constitue[]    findAll()
 * @method Constitue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConstitueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Constitue::class);
    }

//    /**
//     * @return Constitue[] Returns an array of Constitue objects
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

//    public function findOneBySomeField($value): ?Constitue
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
