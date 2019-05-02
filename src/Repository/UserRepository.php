<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

     /**
      * @return User[] Returns an array of User objects
      */
    
     public function findAllUsers()
    {
        return $this->createQueryBuilder('p')
            ->select('p.id, p.email, p.username, p.userlastname, p.adresse, p.ville,
             p.telephone, p.dateNaissance, cb.type, p.pays, p.codePostale,
             cb.numero, cb.dateValidite')
            ->leftJoin('p.cb', 'cb')
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findOneUser($email)
    {
        return $this->createQueryBuilder('p')
        ->select('p.id, p.email, p.username, p.userlastname, p.adresse, p.ville,
        p.telephone, p.dateNaissance, cb.type, p.pays, p.codePostale,
        cb.numero, cb.dateValidite')
            ->leftJoin('p.cb', 'cb')
            ->andWhere('p.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getResult()

        ;
    }
    

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
