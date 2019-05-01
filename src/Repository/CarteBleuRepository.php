<?php

namespace App\Repository;

use App\Entity\CarteBleu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CarteBleu|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteBleu|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteBleu[]    findAll()
 * @method CarteBleu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteBleuRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CarteBleu::class);
    }

    // /**
    //  * @return CarteBleu[] Returns an array of CarteBleu objects
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
    public function findOneBySomeField($value): ?CarteBleu
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
