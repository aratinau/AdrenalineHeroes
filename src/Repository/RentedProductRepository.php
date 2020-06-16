<?php

namespace App\Repository;

use App\Entity\RentedProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RentedProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method RentedProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method RentedProduct[]    findAll()
 * @method RentedProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentedProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RentedProduct::class);
    }

    // /**
    //  * @return RentedProduct[] Returns an array of RentedProduct objects
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
    public function findOneBySomeField($value): ?RentedProduct
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
