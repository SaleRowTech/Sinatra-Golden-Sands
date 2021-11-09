<?php

namespace App\Repository;

use App\Entity\CasinoUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CasinoUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method CasinoUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method CasinoUser[]    findAll()
 * @method CasinoUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CasinoUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CasinoUser::class);
    }

    // /**
    //  * @return CasinoUser[] Returns an array of CasinoUser objects
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
    public function findOneBySomeField($value): ?CasinoUser
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
