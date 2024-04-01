<?php

namespace App\Repository;

use App\Entity\Bar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bar>
 *
 * @method Bar|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bar|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bar[]    findAll()
 * @method Bar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bar::class);
    }

    //    /**
    //     * @return Bar[] Returns an array of Bar objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Bar
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}