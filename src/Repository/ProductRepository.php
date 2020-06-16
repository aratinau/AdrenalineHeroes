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
            ->leftJoin('p.rentedProducts', 'r_from')
            ->where('r_from.rent_from NOT BETWEEN :from AND :to')
            ->leftJoin('p.rentedProducts', 'r_to')
            ->where('r_to.rent_to NOT BETWEEN :from AND :to')

            ->orWhere('r_from.rent_from is null OR r_to.rent_to is null')

            ->addSelect('r_from.rent_from')
            ->addSelect('r_to.rent_to')

            ->andWhere('p.quantity > 0')
            ->setParameter('from', $from)
            ->setParameter('to', $to)
        ;
        return $qb->getQuery()->getArrayResult();
    }
}
