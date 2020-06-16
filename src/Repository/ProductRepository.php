<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function getAvailableProducts($from, $to)
    {
        $from = date_add($from, date_interval_create_from_date_string('2 days'));
        $to = date_add($to, date_interval_create_from_date_string('4 days'));
        
        $qb = $this->createQueryBuilder('p');
        $qb
            ->where('p.rent_from NOT BETWEEN :from AND :to')
            ->andWhere('p.rent_to NOT BETWEEN :from AND :to')
            ->orWhere('p.rent_from is null OR p.rent_to is null')
            ->andWhere('p.quantity > 0')
            ->setParameter('from', $from )
            ->setParameter('to', $to)
        ;
        return $qb->getQuery()->getArrayResult();
    }
}
