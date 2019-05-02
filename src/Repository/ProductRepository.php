<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

     /**
      * @return Product[] Returns an array of Product objects
      */
    
    public function findByLetter($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.name LIKE :name')
            ->setParameter('name', $value.'%')
            ->orderBy('p.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function findAllProduct()
    {
        return $this->createQueryBuilder('p')
            ->select('p.id, p.name, p.description, p.price, p.categorie, p.nbrVentes, (p.vendeur), (p.acheteur), p.img')
            ->orderBy('p.price', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function findAllProductByCat($value)
    {
        return $this->createQueryBuilder('p')
            ->select('p.id, p.name, p.description, p.price, p.categorie, p.nbrVentes, (p.vendeur), (p.acheteur), p.img')
            ->andWhere('p.categorie = :val')
            ->setParameter('val', $value)
            ->orderBy('p.price', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function findPanier($id)
    {
        return $this->createQueryBuilder('p')
            ->select('p.id, p.name, p.description, p.price, p.categorie, p.nbrVentes, acheteur.email, p.img')
            ->leftJoin('p.acheteur', 'acheteur')
            ->andWhere('acheteur.id = :id')
            ->setParameter('id', $id)
            ->orderBy('p.price', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    
    

    /*
    public function findOneBySomeField($value): ?Product
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
