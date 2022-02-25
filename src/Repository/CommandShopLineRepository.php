<?php

namespace App\Repository;

use App\Entity\CommandShopLine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandShopLine|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandShopLine|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandShopLine[]    findAll()
 * @method CommandShopLine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandShopLineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandShopLine::class);
    }

    // /**
    //  * @return CommandShopLine[] Returns an array of CommandShopLine objects
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
    public function findOneBySomeField($value): ?CommandShopLine
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
