<?php

namespace App\Repository;

use App\Entity\Panier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Panier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Panier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Panier[]    findAll()
 * @method Panier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PanierRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Panier::class);
    }

     /**
      * @return Panier[] Returns an array of Panier objects
      */
    
    public function findProductInPanier($userId)
    {
        return $this->createQueryBuilder('p')
        ->select('p.quantiteProduct, product.id, product.name, product.description, product.price, product.quantite, product.categorie, product.nbrVentes,  product.img')
            ->leftJoin('p.product', 'product')
            ->andWhere('p.quantiteProduct > 0')
            ->andWhere('p.user = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function findOnePanier($productId)
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.product', 'product')
            ->andWhere('p.product = :productId')
            ->setParameter('userId', $productId)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Panier
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
