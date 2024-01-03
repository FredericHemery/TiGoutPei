<?php

namespace App\Repository;

use App\Entity\StatusCli;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StatusCli>
 *
 * @method StatusCli|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusCli|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusCli[]    findAll()
 * @method StatusCli[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusCliRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatusCli::class);
    }

//    /**
//     * @return StatusCli[] Returns an array of StatusCli objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StatusCli
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
